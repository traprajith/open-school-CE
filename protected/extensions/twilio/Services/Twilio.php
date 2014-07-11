<?php

//resourse

abstract class Services_Twilio_Resource {
    protected $subresources;

    public function __construct($client, $uri, $params = array())
    {
        $this->subresources = array();
        $this->client = $client;

        foreach ($params as $name => $param) {
            $this->$name = $param;
        }

        $this->uri = $uri;
        $this->init($client, $uri);
    }

    protected function init($client, $uri)
    {
        // Left empty for derived classes to implement
    }

    public function getSubresources($name = null) {
        if (isset($name)) {
            return isset($this->subresources[$name])
                ? $this->subresources[$name]
                : null;
        }
        return $this->subresources;
    }

    protected function setupSubresources()
    {
        foreach (func_get_args() as $name) {
            $constantized = ucfirst(self::camelize($name));
            $type = "Services_Twilio_Rest_" . $constantized;
            $this->subresources[$name] = new $type(
                $this->client, $this->uri . "/$constantized"
            );
        }
    }

    /* 
     * Get the resource name from the classname
     * 
     * Ex: Services_Twilio_Rest_Accounts -> Accounts
     *
     * @param boolean $camelized Whether to return camel case or not
     */
    public function getResourceName($camelized = false) 
    {
        $name = get_class($this);
        $parts = explode('_', $name);
        $basename = end($parts);
        if ($camelized) {
            return $basename;
        } else {
            return self::decamelize($basename);
        }
    }

    public static function decamelize($word)
    {
        return preg_replace(
            '/(^|[a-z])([A-Z])/e',
            'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
            $word
        );
    }

    /**
     * Return camelized version of a word
     * Examples: sms_messages => SMSMessages, calls => Calls, 
     * incoming_phone_numbers => IncomingPhoneNumbers
     *
     * @param string $word The word to camelize
     * @return string
     */
    public static function camelize($word) {
        return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
    }

    /**
     * Get the value of a property on this resource.
     * 
     * @param string $key The property name
     * @return mixed Could be anything.
     */
    public function __get($key) {
        if ($subresource = $this->getSubresources($key)) {
            return $subresource;
        }
        return $this->$key;
    }

    /**
     * Print a JSON representation of this object. Strips the HTTP client 
     * before returning.
     *
     * Note, this should mainly be used for debugging, and is not guaranteed 
     * to correspond 1:1 with the JSON API output.
     *
     * Note that echoing an object before an HTTP request has been made to 
     * "fill in" its properties may return an empty object
     */
    public function __toString() {
        $out = array();
        foreach ($this as $key => $value) {
            if ($key !== "client" && $key !== "subresources") {
                $out[$key] = (string)$value;
            }
        }
        return json_encode($out);
    }

}
//resourse end


//list resourse

abstract class Services_Twilio_ListResource
    extends Services_Twilio_Resource
    implements IteratorAggregate, Countable
{

    public function __construct($client, $uri) {
        $name = $this->getResourceName(true);
        /* 
         * By default trim the 's' from the end of the list name to get the
         * instance name (ex Accounts -> Account). This behavior can be
         * overridden by child classes if the rule doesn't work.
         */
        if (!isset($this->instance_name)) {
            $this->instance_name = "Services_Twilio_Rest_" . rtrim($name, 's');
        }
        parent::__construct($client, $uri);
    }

    /**
     * Gets a resource from this list.
     *
     * @param string $sid The resource SID
     * @return Services_Twilio_InstanceResource The resource
     */
    public function get($sid)
    {
        $instance = new $this->instance_name(
            $this->client, $this->uri . "/$sid"
        );
        // XXX check if this is actually a sid in all cases.
        $instance->sid = $sid;
        return $instance;
    }

    /* 
     * Construct an InstanceResource with the specified params.
     *
     * @param array params usually a JSON HTTP response from the API
     * @return Services_Twilio_InstanceResource An instance with properties 
     *      initialized to the values in the params array.
     */
    public function getObjectFromJson($params, $idParam = "sid")
    {
        if (isset($params->{$idParam})) {
            $uri = $this->uri . "/" . $params->{$idParam};
        } else {
            $uri = $this->uri;
        }
        return new $this->instance_name($this->client, $uri, $params);
    }

    /**
     * Deletes a resource from this list.
     *
     * @param string $sid The resource SID
     * @return null
     */
    public function delete($sid, array $params = array())
    {
        $this->client->deleteData($this->uri . '/' . $sid, $params);
    }

    /**
     * Create a resource on the list and then return its representation as an
     * InstanceResource.
     *
     * @param array $params The parameters with which to create the resource
     *
     * @return Services_Twilio_InstanceResource The created resource
     */
    protected function _create(array $params)
    {
        $params = $this->client->createData($this->uri, $params);
        /* Some methods like verified caller ID don't return sids. */
        if (isset($params->sid)) {
            $resource_uri = $this->uri . '/' . $params->sid;
        } else {
            $resource_uri = $this->uri;
        }
        return new $this->instance_name($this->client, $resource_uri, $params);
    }

    /**
     * Returns a page of InstanceResources from this list.
     *
     * @param int    $page The start page
     * @param int    $size Number of items per page
     * @param array  $filters Optional filters
     * @param string $deep_paging_uri if provided, the $page and $size 
     *      parameters will be ignored and this URI will be requested directly.
     *
     * @return Services_Twilio_Page A page
     */
    public function getPage(
        $page = 0, $size = 50, array $filters = array(), 
        $deep_paging_uri = null
    ) {
        $list_name = $this->getResourceName();
        if ($deep_paging_uri !== null) {
            $page = $this->client->retrieveData($deep_paging_uri, array(), true);
        } else {
            $page = $this->client->retrieveData($this->uri, array(
                'Page' => $page,
                'PageSize' => $size,
            ) + $filters);
        }

        /* create a new PHP object for each json obj in the api response. */
        $page->$list_name = array_map(
            array($this, 'getObjectFromJson'),
            $page->$list_name
        );
        if (isset($page->next_page_uri)) {
            $next_page_uri = $page->next_page_uri;
        } else {
            $next_page_uri = null;
        }
        return new Services_Twilio_Page($page, $list_name, $next_page_uri);
    }

    /**
     * Get the total number of instance members. Note this will make one small 
     * HTTP request to retrieve the total, every time this method is called.
     *
     * If the total is not set or an Exception was thrown, returns 0
     *
     * @return integer
     *
     */
    public function count() {
        try {
            $page = $this->getPage(0, 1);
            return $page ? (int)$page->total : 0;
        } catch (Exception $e) {
            return 0;
        }
    }


    /**
     * Returns an iterable list of InstanceResources
     *
     * @param int   $page The start page
     * @param int   $size Number of items per page
     * @param array $size Optional filters
     *
     * The filter array can accept full datetimes when StartTime or DateCreated
     * are used. Inequalities should be within the key portion of the array and
     * multiple filter parameters can be combined for more specific searches.
     *
     * eg.
     *   array('DateCreated>' => '2011-07-05 08:00:00', 'DateCreated<' => '2011-08-01')
     * or
     *   array('StartTime<' => '2011-07-05 08:00:00')
     *
     * @return Services_Twilio_AutoPagingIterator An iterator
     */
    public function getIterator(
        $page = 0, $size = 50, array $filters = array()
    ) {
        return new Services_Twilio_AutoPagingIterator(
            array($this, 'getPageGenerator'), $page, $size, $filters
        );
    }

    /* 
     * Retrieve a new page of API results, and update iterator parameters.
     */
    public function getPageGenerator(
        $page, $size, array $filters = array(), $deep_paging_uri = null
    ) {
        return $this->getPage($page, $size, $filters, $deep_paging_uri);
    }
}

//list resourse end

class Services_Twilio_UsageResource extends Services_Twilio_ListResource {
    public function getResourceName($camelized = false) {
        $this->instance_name = 'Services_Twilio_Rest_UsageRecord';
        return $camelized ? 'UsageRecords' : 'usage_records';
    }

    public function __construct($client, $uri) {
        $uri = preg_replace("#UsageRecords#", "Usage/Records", $uri);
        parent::__construct($client, $uri);
    }
}

class Services_Twilio_TimeRangeResource extends Services_Twilio_UsageResource {

    /**
     * Return a UsageRecord corresponding to the given category.
     *
     * @param string $category The category of usage to retrieve. For a full 
     *      list of valid categories, please see the documentation at 
     *      http://www.twilio.com/docs/api/rest/usage-records#usage-all-categories
     * @return Services_Twilio_Rest_UsageRecord
     * @throws Services_Twilio_RestException
     */
    public function getCategory($category) {
        $page = $this->getPage(0, 1, array(
            'Category' => $category,
        ));
        $items = $page->getItems();
        if (!is_array($items) || count($items) === 0) {
            throw new Services_Twilio_RestException(
                400, "Usage record data is unformattable.");
        }
        return $items[0];
    }
}

class Services_Twilio_Rest_Applications
    extends Services_Twilio_ListResource
{
    public function create($name, array $params = array())
    {
        return parent::_create(array(
            'FriendlyName' => $name
        ) + $params);
    }
}

class Services_Twilio_Rest_AvailablePhoneNumbers
    extends Services_Twilio_ListResource
{
    public function getLocal($country)
    {
        $curried = new Services_Twilio_PartialApplicationHelper();
        $curried->set(
            'getList',
            array($this, 'getList'),
            array($country, 'Local')
        );
        return $curried;
    }
    public function getTollFree($country)
    {
        $curried = new Services_Twilio_PartialApplicationHelper();
        $curried->set(
            'getList',
            array($this, 'getList'),
            array($country, 'TollFree')
        );
        return $curried;
    }

    /**
     * Get a list of available phone numbers. 
     *
     * @param string $country The 2-digit country code you'd like to search for
     *    numbers e.g. ('US', 'CA', 'GB')
     * @param string $type The type of number ('Local' or 'TollFree')
     * @return object The object representation of the resource
     */
    public function getList($country, $type, array $params = array())
    {
        return $this->client->retrieveData($this->uri . "/$country/$type", $params);
    }

    public function getResourceName($camelized = false)
    {
        // You can't page through the list of available phone numbers.
        $this->instance_name = 'Services_Twilio_Rest_AvailablePhoneNumber';
        return $camelized ? 'Countries' : 'countries';
    }
}


class Services_Twilio_Rest_OutgoingCallerIds
    extends Services_Twilio_ListResource
{
    public function create($phoneNumber, array $params = array())
    {
        return parent::_create(array(
            'PhoneNumber' => $phoneNumber,
        ) + $params);
    }
}



class Services_Twilio_Rest_Calls
    extends Services_Twilio_ListResource
{

    public static function isApplicationSid($value)
    {
        return strlen($value) == 34
            && !(strpos($value, "AP") === false);
    }

    public function create($from, $to, $url, array $params = array())
    {

        $params["To"] = $to;
        $params["From"] = $from;

        if (self::isApplicationSid($url)) {
            $params["ApplicationSid"] = $url;
        } else {
            $params["Url"] = $url;
        }

        return parent::_create($params);
    }
}


class Services_Twilio_Rest_Conferences
    extends Services_Twilio_ListResource
{
}

class Services_Twilio_Rest_IncomingPhoneNumbers
    extends Services_Twilio_ListResource
{
    function create(array $params = array()) {
        return parent::_create($params);
    }

    /**
     * Return a phone number instance from its E.164 representation. If more
     * than one number matches the search string, returns the first one.
     *
     * @param string $number The number in E.164 format, eg "+684105551234"
     * @return Services_Twilio_Rest_IncomingPhoneNumber|null The number object, 
     *      or null
     * 
     * @throws Services_Twilio_RestException if the number is invalid, not 
     *      provided in E.164 format or for any other API exception.
     */
    public function getNumber($number) {
        $page = $this->getPage(0, 1, array(
            'PhoneNumber' => $number
        ));
        $items = $page->getItems();
        if (is_null($items) || empty($items)) {
            return null;
        }
        return $items[0];
    }
}

class Services_Twilio_Rest_Notifications
    extends Services_Twilio_ListResource
{
}

class Services_Twilio_Rest_Recordings
    extends Services_Twilio_ListResource
{
}

class Services_Twilio_Rest_SmsMessages
    extends Services_Twilio_ListResource
{
    public function __construct($client, $uri) {
        $uri = preg_replace("#SmsMessages#", "SMS/Messages", $uri);
        parent::__construct($client, $uri);
    }

    function create($from, $to, $body, array $params = array()) {
        return parent::_create(array(
            'From' => $from,
            'To' => $to,
            'Body' => $body
        ) + $params);
    }
}

class Services_Twilio_Rest_ShortCodes
    extends Services_Twilio_ListResource
{
    public function __construct($client, $uri) {
        $uri = preg_replace("#ShortCodes#", "SMS/ShortCodes", $uri);
        parent::__construct($client, $uri);
    }
}

class Services_Twilio_Rest_Transcriptions
    extends Services_Twilio_ListResource
{
}

class Services_Twilio_Rest_ConnectApps
    extends Services_Twilio_ListResource
{
    public function create($name, array $params = array())
    {
        throw new BadMethodCallException('Not allowed');
    }
}

class Services_Twilio_Rest_AuthorizedConnectApps
    extends Services_Twilio_ListResource
{
   public function create($name, array $params = array())
    {
        throw new BadMethodCallException('Not allowed');
    }
}

class Services_Twilio_Rest_UsageRecords extends Services_Twilio_TimeRangeResource {

    public function init($client, $uri) {
        $this->setupSubresources(
            'today',
            'yesterday',
            'all_time',
            'this_month',
            'last_month',
            'daily',
            'monthly',
            'yearly'
        );
    }
}

class Services_Twilio_Rest_Today extends Services_Twilio_TimeRangeResource { } 

class Services_Twilio_Rest_Yesterday extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_LastMonth extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_ThisMonth extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_AllTime extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_Daily extends Services_Twilio_UsageResource { }

class Services_Twilio_Rest_Monthly extends Services_Twilio_UsageResource { }

class Services_Twilio_Rest_Yearly extends Services_Twilio_UsageResource { }


class Services_Twilio_Rest_UsageTriggers extends Services_Twilio_ListResource {

    public function __construct($client, $uri) {
        $uri = preg_replace("#UsageTriggers#", "Usage/Triggers", $uri);
        parent::__construct($client, $uri);
    }

    /**
     * Create a new UsageTrigger
     * @param string $category The category of usage to fire a trigger for. A full list of categories can be found in the `Usage Categories documentation <http://www.twilio.com/docs/api/rest/usage-records#usage-categories>`_.
     * @param string $value Fire the trigger when usage crosses this value.
     * @param string $url The URL to request when the trigger fires.
     * @param array $params Optional parameters for this trigger. A full list of parameters can be found in the `Usage Trigger documentation <http://www.twilio.com/docs/api/rest/usage-triggers#list-post-optional-parameters>`_.
     * @return Services_Twilio_Rest_UsageTrigger The created trigger
     */
    function create($category, $value, $url, array $params = array()) {
        return parent::_create(array(
            'UsageCategory' => $category,
            'TriggerValue' => $value,
            'CallbackUrl' => $url,
        ) + $params);
    }

}


class Services_Twilio_Rest_Queues
    extends Services_Twilio_ListResource
{
    /**
     * Create a new Queue
     *
     * @param string $friendly_name The name of this queue
     * @param array $params A list of optional parameters, and their values
     * @return Services_Twilio_Rest_Queue The created Queue
     */
    function create($friendly_name, array $params = array()) {
        return parent::_create(array(
            'FriendlyName' => $friendly_name,
        ) + $params);
    }
}

//instant resourse

abstract class Services_Twilio_InstanceResource
    extends Services_Twilio_Resource
{
    /**
     * @param mixed $params An array of updates, or a property name
     * @param mixed $value  A value with which to update the resource
     *
     * @return null
     */
    public function update($params, $value = null)
    {
        if (!is_array($params)) {
            $params = array($params => $value);
        }
        $decamelizedParams = $this->client->createData($this->uri, $params);
        $this->updateAttributes($decamelizedParams);
    }

    /* 
     * Add all properties from an associative array (the JSON response body) as 
     * properties on this instance resource, except the URI
     *
     * @param stdClass $params An object containing all of the parameters of 
     *      this instance
     * @return null Purely side effecting
     */
    public function updateAttributes($params) {
        unset($params->uri);
        foreach ($params as $name => $value) {
            $this->$name = $value;
        }
    }

    /**
     * Get the value of a property on this resource.
     * 
     * To help with lazy HTTP requests, we don't actually retrieve an object 
     * from the API unless you really need it. Hence, this function may make 
     * API requests if the property you're requesting isn't available on the 
     * resource.
     *
     * @param string $key The property name
     *
     * @return mixed Could be anything.
     */
    public function __get($key)
    {
        if ($subresource = $this->getSubresources($key)) {
            return $subresource;
        }
        if (!isset($this->$key)) {
            $params = $this->client->retrieveData($this->uri);
            $this->updateAttributes($params);
        }
        return $this->$key;
    }
}

// instant resourse end

class Services_Twilio_Rest_Sandbox
    extends Services_Twilio_InstanceResource
{
}

class Services_Twilio_Rest_SmsMessage
    extends Services_Twilio_InstanceResource
{
}

class Services_Twilio_RestException
    extends Exception
{
    protected $status;
    protected $info;

    public function __construct($status, $message, $code = 0, $info = '')
    {
        $this->status = $status;
        $this->info = $info;
        parent::__construct($message, $code);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getInfo()
    {
        return $this->info;
    }
}
//rest account

class Services_Twilio_Rest_Account extends Services_Twilio_InstanceResource {

    protected function init($client, $uri) {
        $this->setupSubresources(
            'applications',
            'available_phone_numbers',
            'outgoing_caller_ids',
            'calls',
            'conferences',
            'incoming_phone_numbers',
            'notifications',
            'outgoing_callerids',
            'recordings',
            'sms_messages',
            'short_codes',
            'transcriptions',
            'connect_apps',
            'authorized_connect_apps',
            'usage_records',
            'usage_triggers',
            'queues'
        );

        $this->sandbox = new Services_Twilio_Rest_Sandbox(
            $client, $uri . '/Sandbox'
        );
    }
}

//rest account end

//accounts

class Services_Twilio_Rest_Accounts
    extends Services_Twilio_ListResource
{
    public function create(array $params = array())
    {
        return parent::_create($params);
    }
}
//accounts end



//tiny


class Services_Twilio_TinyHttpException extends ErrorException {}

class Services_Twilio_TinyHttp {
  var $user, $pass, $scheme, $host, $port, $debug, $curlopts;

  public function __construct($uri = '', $kwargs = array()) {
    foreach (parse_url($uri) as $name => $value) $this->$name = $value;
    $this->debug = isset($kwargs['debug']) ? !!$kwargs['debug'] : NULL;
    $this->curlopts = isset($kwargs['curlopts']) ? $kwargs['curlopts'] : array();
  }

  public function __call($name, $args) {
    list($res, $req_headers, $req_body) = $args + array(0, array(), '');

    $opts = $this->curlopts + array(
      CURLOPT_URL => "$this->scheme://$this->host$res",
      CURLOPT_HEADER => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_INFILESIZE => -1,
      CURLOPT_POSTFIELDS => NULL,
      CURLOPT_TIMEOUT => 60,
    );

    foreach ($req_headers as $k => $v) $opts[CURLOPT_HTTPHEADER][] = "$k: $v";
    if ($this->port) $opts[CURLOPT_PORT] = $this->port;
    if ($this->debug) $opts[CURLINFO_HEADER_OUT] = TRUE;
    if ($this->user && $this->pass) $opts[CURLOPT_USERPWD] = "$this->user:$this->pass";
    switch ($name) {
    case 'get':
      $opts[CURLOPT_HTTPGET] = TRUE;
      break;
    case 'post':
      $opts[CURLOPT_POST] = TRUE;
      $opts[CURLOPT_POSTFIELDS] = $req_body;
      break;
    case 'put':
      $opts[CURLOPT_PUT] = TRUE;
      if (strlen($req_body)) {
        if ($buf = fopen('php://memory', 'w+')) {
          fwrite($buf, $req_body);
          fseek($buf, 0);
          $opts[CURLOPT_INFILE] = $buf;
          $opts[CURLOPT_INFILESIZE] = strlen($req_body);
        } else throw new Services_Twilio_TinyHttpException('unable to open temporary file');
      }
      break;
    case 'head':
      $opts[CURLOPT_NOBODY] = TRUE;
      break;
    default:
      $opts[CURLOPT_CUSTOMREQUEST] = strtoupper($name);
      break;
    }
    try {
      if ($curl = curl_init()) {
        if (curl_setopt_array($curl, $opts)) {
          if ($response = curl_exec($curl)) {
            $parts = explode("\r\n\r\n", $response, 3);
            list($head, $body) = ($parts[0] == 'HTTP/1.1 100 Continue')
              ? array($parts[1], $parts[2])
              : array($parts[0], $parts[1]);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($this->debug) {
              error_log(
                curl_getinfo($curl, CURLINFO_HEADER_OUT) .
                $req_body
              );
            }
            $header_lines = explode("\r\n", $head);
            array_shift($header_lines);
            foreach ($header_lines as $line) {
              list($key, $value) = explode(":", $line, 2);
              $headers[$key] = trim($value);
            }
            curl_close($curl);
            if (isset($buf) && is_resource($buf)) {
                fclose($buf);
            }
            return array($status, $headers, $body);
          } else { 
              throw new Services_Twilio_TinyHttpException(curl_error($curl));
          }
        } else throw new Services_Twilio_TinyHttpException(curl_error($curl));
      } else throw new Services_Twilio_TinyHttpException('unable to initialize cURL');
    } catch (ErrorException $e) {
      if (is_resource($curl)) curl_close($curl);
      if (isset($buf) && is_resource($buf)) fclose($buf);
      throw $e;
    }
  }

  public function authenticate($user, $pass) {
    $this->user = $user;
    $this->pass = $pass;
  }
}

//tiny end




function Services_Twilio_autoload($className) {
    if (substr($className, 0, 15) != 'Services_Twilio') {
        return false;
    }
    $file = str_replace('_', '/', $className);
    $file = str_replace('Services/', '', $file);
    return include dirname(__FILE__) . "/$file.php";
}

spl_autoload_register('Services_Twilio_autoload');

/**
 * Twilio API client interface.
 *
 * @category Services
 * @package  Services_Twilio
 * @author   Neuman Vong <neuman@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     http://pear.php.net/package/Services_Twilio
 */
 class Services_Twilio_Rest_Call
    extends Services_Twilio_InstanceResource
{
    public function hangup()
    {
        $this->update('Status', 'completed');
    }

    public function route($url) {
        $this->update('Url', $url);
    }

    protected function init($client, $uri)
    {
        $this->setupSubresources(
            'notifications',
            'recordings'
        );
    }
}

class Services_Twilio extends Services_Twilio_Resource
{
    const USER_AGENT = 'twilio-php/3.10.0';

    protected $http;
    protected $retryAttempts;
    protected $last_response;
    protected $version;
    protected $versions = array('2008-08-01', '2010-04-01');

    /**
     * Constructor.
     *
     * @param string               $sid      Account SID
     * @param string               $token    Account auth token
     * @param string               $version  API version
     * @param Services_Twilio_Http $_http    A HTTP client
     * @param int                  $retryAttempts Number of times to retry failed requests
     */
    public function __construct(
        $sid,
        $token,
        $version = null,
        Services_Twilio_TinyHttp $_http = null,
        $retryAttempts = 1
    ) {
        $this->version = in_array($version, $this->versions) ?
                $version : end($this->versions);

        if (null === $_http) {
            if (!in_array('curl', get_loaded_extensions())) {
                trigger_error("It looks like you do not have curl installed.\n". 
                    "Curl is required to make HTTP requests using the twilio-php\n" .
                    "library. For install instructions, visit the following page:\n" . 
                    "http://php.net/manual/en/curl.installation.php",
                    E_USER_WARNING
                );
            }
            $_http = new Services_Twilio_TinyHttp(
                "https://api.twilio.com",
                array("curlopts" => array(
                    CURLOPT_USERAGENT => self::USER_AGENT,
                    CURLOPT_HTTPHEADER => array('Accept-Charset: utf-8'),
                    CURLOPT_CAINFO => dirname(__FILE__) . '/cacert.pem',
                ))
            );
        }
        $_http->authenticate($sid, $token);
        $this->http = $_http;
        $this->accounts = new Services_Twilio_Rest_Accounts($this, "/{$this->version}/Accounts");
        $this->account = $this->accounts->get($sid);
        $this->retryAttempts = $retryAttempts;
    }

    /**
     * Get the api version used by the rest client
     *
     * @return string the API version in use
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * Get the retry attempt limit used by the rest client
     *
     * @return int the number of retry attempts
     */
    public function getRetryAttempts() {
        return $this->retryAttempts;
    }

    /**
     * Construct a URI based on initial path, query params, and paging 
     * information
     *
     * We want to use the query params, unless we have a next_page_uri from the 
     * API.
     *
     * @param string $path The request path (may contain query params if it's 
     *      a next_page_uri)
     * @param array $params Query parameters to use with the request
     * @param boolean $full_uri Whether the $path contains the full uri
     *
     * @return string the URI that should be requested by the library
     */
    public static function getRequestUri($path, $params, $full_uri = false) {
        $json_path = $full_uri ? $path : "$path.json";
        if (!$full_uri && !empty($params)) {
            $query_path = $json_path . '?' . http_build_query($params, '', '&');
        } else {
            $query_path = $json_path;
        }
        return $query_path;
    }

    /**
     * Helper method for implementing request retry logic
     *
     * @param array  $callable      The function that makes an HTTP request
     * @param string $uri           The URI to request
     * @param int    $retriesLeft   Number of times to retry
     *
     * @return object The object representation of the resource
     */
    protected function _makeIdempotentRequest($callable, $uri, $retriesLeft) {
        $response = call_user_func_array($callable, array($uri));
        list($status, $headers, $body) = $response;
        if ($status >= 500 && $retriesLeft > 0) {
            return $this->_makeIdempotentRequest($callable, $uri, $retriesLeft - 1);
        } else {
            return $this->_processResponse($response);
        }
    }

    /**
     * GET the resource at the specified path.
     *
     * @param string $path   Path to the resource
     * @param array  $params Query string parameters
     * @param boolean  $full_uri Whether the full URI has been passed as an 
     *      argument
     *
     * @return object The object representation of the resource
     */
    public function retrieveData($path, array $params = array(), 
        $full_uri = false
    ) {
        $uri = self::getRequestUri($path, $params, $full_uri);
        return $this->_makeIdempotentRequest(array($this->http, 'get'), 
            $uri, $this->retryAttempts);
    }

    /**
     * DELETE the resource at the specified path.
     *
     * @param string $path   Path to the resource
     * @param array  $params Query string parameters
     *
     * @return object The object representation of the resource
     */
    public function deleteData($path, array $params = array())
    {
        $uri = self::getRequestUri($path, $params);
        return $this->_makeIdempotentRequest(array($this->http, 'delete'), 
            $uri, $this->retryAttempts);
    }

    /**
     * POST to the resource at the specified path.
     *
     * @param string $path   Path to the resource
     * @param array  $params Query string parameters
     *
     * @return object The object representation of the resource
     */
    public function createData($path, array $params = array())
    {
        $path = "$path.json";
        $headers = array('Content-Type' => 'application/x-www-form-urlencoded');
        $response = $this->http->post(
            $path, $headers, http_build_query($params, '', '&')
        );
        return $this->_processResponse($response);
    }

    /**
     * Convert the JSON encoded resource into a PHP object.
     *
     * @param array $response 3-tuple containing status, headers, and body
     *
     * @return object PHP object decoded from JSON
     * @throws Services_Twilio_RestException (Response in 300-500 class)
     */
    private function _processResponse($response)
    {
        list($status, $headers, $body) = $response;
        if ($status === 204) {
            return true;
        }
        $decoded = json_decode($body);
        if ($decoded === null) {
            throw new Services_Twilio_RestException(
                $status,
                'Could not decode response body as JSON. ' . 
                'This likely indicates a 500 server error'
            );
        }
        if (200 <= $status && $status < 300) {
            $this->last_response = $decoded;
            return $decoded;
        }
        throw new Services_Twilio_RestException(
            $status,
            isset($decoded->message) ? $decoded->message : '',
            isset($decoded->code) ? $decoded->code : null,
            isset($decoded->more_info) ? $decoded->more_info : null
        );
    }
	
	
	
	
}
