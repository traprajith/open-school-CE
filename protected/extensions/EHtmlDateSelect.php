<?php
/**
*       EHtmlDateSelect is a widget that creates date dropdowns.
*       It can display any or all of year, month, and day.
*       Based on the Smarty function {html_select_date}
*       http://www.smarty.net/manual/en/language.function.html.select.date.php
*
*       EHtmlDateSelect является виджетом, который создает выпадающее меню для выбора даты.
*       Она может отображать поля для года, месяца и дня.
*       Основано на функции Smarty {html_select_date}
*       http://www.smarty.net/manual/ru/language.function.html.select.date.php
*
*       @author Vladimir Papaev <kosenka@gmail.com>
*       @version 0.3
*
*       usage sample:
*       $this->widget('application.extensions.EHtmlDateSelect',
*                        array(
*                              'time'=>time(), // $model->dateField
*                              'field_array'=>'ItemsDate',
*                              'prefix'=>'',
*                              'field_order'=>'DMY',
*                              'start_year'=>2010,
*                              'end_year'=>2012,
*                             )
*                       );
*
*       $this->widget('application.extensions.EHtmlDateSelect',
*                        array(
*                              'time'=>date('Y-m-d', strtotime('+2 week')),
*                              'field_array'=>'ItemsDate',
*                              'prefix'=>'',
*                              'field_order'=>'DMY',
*                              'end_year'=>'+2',
*                             )
*                       );
*
**/
class EHtmlDateSelect extends CWidget
{
        // What to prefix the var name with
        // префикс названий переменных
        public $prefix          ; 
        
        // What date/time to use
        // текущее время в формате unix timestamp или ГГГГ-ММ-ДД
        public $time            ;

        // The first year in the dropdown, either year number, or relative to current year (+/- N)
        // Начальный год в выпадающем списке. Либо указывается явно, либо относительно текущего года (+/- N)
        public $start_year      ; 
        
        // The last year in the dropdown, either year number, or relative to current year (+/- N)
        // Конечный год в выпадающем списке. Либо указывается явно, либо относительно текущего года (+/- N)
        public $end_year        ; 
        
        //Whether to display days or not
        // выводить ли список дней
        public $display_days    ; 
        
        //Whether to display months or not
        // выводить ли список месяцев
        public $display_months  ; 
        
        //Whether to display years or not
        // выводить ли список лет
        public $display_years   ;

        //What format the month should be in (strftime)
        // Формат названия месяцев (strftime)
        public $month_format    ; 
        
        //strftime() format of the month values, default is %m for month numbers.
        //формат значения месяца (strftime). По умолчанию - %m (номер месяца)
        public $month_value_format ;
        
        //What format the day output should be in (sprintf)
        // формат названия дней (sprintf)
        public $day_format      ; 
        
        //What format the day value should be in (sprintf)
        // формат значения дней (sprintf)
        public $day_value_format ;

        //Whether or not to display the year as text
        //Выводить ли значение года текстом
        public $year_as_text    ; 
        
        //Display years in reverse order
        //Выводить года в обратном порядке
        public $reverse_years   ; 
        
        //If a name is given, the select boxes will be drawn such that the results will be returned to PHP in the form of name[Day], name[Year], name[Month]
        // название переменной (name), которая будет содержать выбранные значения в виде массива: name[Day], name[Year], name[Month]
        public $field_array     ; 

        //Adds size attribute to select tag if given
        //Устанавливает атрибут size тэга select для дней
        public $day_size        ;
        
        //Adds size attribute to select tag if given
        //Устанавливает атрибут size тэга select для месяцев
        public $month_size      ;
        
        //Adds size attribute to select tag if given
        //Устанавливает атрибут size тэга select для лет
        public $year_size       ;
        
        //Adds extra attributes to all select/input tags if given
        //Устанавливает дополнительные атрибуты для всех тэгов select/input
        public $all_extra       ;
        
        //Adds extra attributes to select/input tags if given
        //Устанавливает дополнительные атрибуты тэгов select/input для дней
        public $day_extra       ;
        
        //Adds extra attributes to select/input tags if given
        //Устанавливает дополнительные атрибуты тэгов select/input для месяцев
        public $month_extra     ;
        
        //Adds extra attributes to select/input tags if given
        //Устанавливает дополнительные атрибуты тэгов select/input для лет
        public $year_extra      ;
        
        //The order in which to display the fields
        //Порядок следования полей (МДГ)
        public $field_order     ;
        
        //String printed between different fields
        //текст, разделяющий поля
        public $field_separator ;

        //If supplied then the first element of the year's select-box has this value as it's label and "" as it's value.
        //This is useful to make the select-box read "Please select a year" for example.
        //Note that you can use values like "-MM-DD" as time-attribute to indicate an unselected year.
        //Если указан, первый пункт элемента для выбора дня станет такой надписью с пустым ("") значением.
        //Обратите внимание, что вы можете использовать значения типа "YYY-MM-" для атрибута time, чтобы не выбирать день заранее.
        public $day_empty       ;

        //If supplied then the first element of the month's select-box has this value as it's label and "" as it's value.
        //Note that you can use values like "YYYY--DD" as time-attribute to indicate an unselected month.
        //Если указан, первый пункт элемента для выбора месяца станет такой надписью с пустым ("") значением.
        //Обратите внимание, что вы можете использовать значения типа "YYYY--DD" для атрибута time, чтобы не выбирать месяц заранее.
        public $month_empty     ;

        //If supplied then the first element of the day's select-box has this value as it's label and "" as it's value.
        //Note that you can use values like "YYYY-MM-" as time-attribute to indicate an unselected day.
        //Если указан, первый пункт элемента для выбора года станет такой надписью с пустым ("") значением.
        //Это удобно для создания надписей вроде "Пожалуйста, выберите год" в качестве первого пункта выпадающего меню.
        //Обратите внимание, что вы можете использовать значения типа "-MM-DD" для атрибута time, чтобы не выбирать год заранее.
        public $year_empty      ;
        
        private $month_names_locale;

        public function init()
        {
                $this->month_names_locale=Yii::app()->getLocale()->getMonthNames('wide',true);
                
                if(!isset($this->prefix)) $this->prefix = "Date_";
                if(!isset($this->start_year) or empty($this->start_year)) $this->start_year = strftime("%Y");
                if(!isset($this->end_year) or empty($this->end_year)) $this->end_year  = $this->start_year;
                if(!isset($this->display_days)) $this->display_days    = true;
                if(!isset($this->display_months)) $this->display_months  = true;
                if(!isset($this->display_years)) $this->display_years   = true;
                if(!isset($this->month_format) or empty($this->month_format)) $this->month_format    = "%B";
                /* Write months as numbers by default  GL */
                if(!isset($this->month_value_format) or empty($this->month_value_format)) $this->month_value_format = "%m";
                if(!isset($this->day_format) or empty($this->day_format)) $this->day_format      = "%02d";
                /* Write day values using this format MB */
                if(!isset($this->day_value_format) or empty($this->day_value_format)) $this->day_value_format = "%d";
                if(!isset($this->year_as_text)) $this->year_as_text    = false;
                /* Display years in reverse order? Ie. 2000,1999,.... */
                if(!isset($this->reverse_years)) $this->reverse_years   = false;
                /* Should the select boxes be part of an array when returned from PHP?
                e.g. setting it to "birthday", would create "birthday[Day]",
                "birthday[Month]" & "birthday[Year]". Can be combined with prefix */
                if(!isset($this->field_array)) $this->field_array     = null;
                /* <select size>'s of the different <select> tags.
                If not set, uses default dropdown. */
                if(!isset($this->day_size)) $this->day_size        = null;
                if(!isset($this->month_size)) $this->month_size      = null;
                if(!isset($this->year_size)) $this->year_size       = null;
                /* Unparsed attributes common to *ALL* the <select>/<input> tags.
                An example might be in the template: all_extra ='class ="foo"'. */
                if(!isset($this->all_extra)) $this->all_extra       = null;
                /* Separate attributes for the tags. */
                if(!isset($this->day_extra)) $this->day_extra       = null;
                if(!isset($this->month_extra)) $this->month_extra     = null;
                if(!isset($this->year_extra)) $this->year_extra      = null;
                /* Order in which to display the fields.
                "D" -> day, "M" -> month, "Y" -> year. */
                if(!isset($this->field_order) or empty($this->field_order)) $this->field_order     = 'MDY';
                /* String printed between the different fields. */
                if(!isset($this->field_separator)) $this->field_separator = "\n";
                if(!isset($this->time)) $this->time = time();
                if(!isset($this->day_empty)) $this->day_empty       = null;
                if(!isset($this->month_empty)) $this->month_empty     = null;
                if(!isset($this->year_empty)) $this->year_empty      = null;
        }

        public function run()
        {
                if (preg_match('!^-\d+$!', $this->time))
                {
                        // negative timestamp, use date()
                        $this->time = date('Y-m-d', $this->time);
                }

                // If $time is not in format yyyy-mm-dd
                if (preg_match('/^(\d{0,4}-\d{0,2}-\d{0,2})/', $this->time, $found))
                {
                        $this->time = $found[1];
                }
                else
                {
                        // use make_timestamp to get an unix timestamp and
                        // strftime to make yyyy-mm-dd
                        $this->time = strftime('%Y-%m-%d', $this->make_timestamp($this->time));
                }

                // Now split this in pieces, which later can be used to set the select
                $this->time = explode("-", $this->time);

                // make syntax "+N" or "-N" work with start_year and end_year
                if (preg_match('!^(\+|\-)\s*(\d+)$!', $this->end_year, $match))
                {
                        if ($match[1] == '+')
                        {
                                $this->end_year = (int)$this->time[0] + $match[2];
                        }
                        else
                        {
                                $this->end_year = (int)$this->time[0] - $match[2];
                        }
                }

                if (preg_match('!^(\+|\-)\s*(\d+)$!', $this->start_year, $match))
                {
                        if ($match[1] == '+')
                        {
                                $this->start_year = (int)$this->time[0] + $match[2];
                        }
                        else
                        {
                                $this->start_year = (int)$this->time[0] - $match[2];
                        }
                }
                
                //added on v.0.3
                if ((int)$this->start_year == (int)$this->end_year)
                {
                        $this->start_year = $this->time[0];
                }
                //added on v.0.3

                if (strlen($this->time[0]) > 0)
                {
                        if ((int)$this->start_year > (int)$this->time[0])// && !isset($this->start_year))
                        {
                                // force start year to include given date if not explicitly set
                                $this->start_year = $this->time[0];
                        }
                        
                        if((int)$this->end_year < (int)$this->time[0])// && !isset($this->end_year))
                        {
                                // force end year to include given date if not explicitly set
                                $this->end_year = $this->time[0];
                        }
                }

                $this->field_order = strtoupper($this->field_order);

                $html_result = $month_result = $day_result = $year_result = "";

                if ($this->display_months)
                {
                        $month_names = array();
                        $month_values = array();
                        if(isset($this->month_empty))
                        {
                                $month_names[''] = $this->month_empty;
                                $month_values[''] = '';
                        }

                        for ($i = 1; $i <= 12; $i++)
                        {
                                $month_names[$i] = $this->month_names_locale[$i];//strftime($this->month_format, mktime(0, 0, 0, $i, 1, 2000));
                                $month_values[$i] = strftime($this->month_value_format , mktime(0, 0, 0, $i, 1, 2050));
                        }

                        $month_result .= '<select name=';
                        if (null !== $this->field_array)
                        {
                                $month_result .= '"' . $this->field_array . '[' . $this->prefix . 'Month]"';
                        }
                        else
                        {
                                $month_result .= '"' . $this->prefix . 'Month"';
                        }

                        if (null !== $this->month_size)
                        {
                                $month_result .= ' size="' . $this->month_size . '"';
                        }

                        if (null !== $this->month_extra)
                        {
                                $month_result .= ' ' . $this->month_extra;
                        }
                        
                        if (null !== $this->all_extra)
                        {
                                $month_result .= ' ' . $this->all_extra;
                        }
                        
                        $month_result .= '>'."\n";

                        $month_result .= $this->html_options(
                                                              array(
                                                                    'output'     => $month_names,
                                                                    'values'     => $month_values,
                                                                    'selected'   => (int)$this->time[1] ? strftime($this->month_value_format, mktime(0, 0, 0, (int)$this->time[1], 1, 2050)) : '',
                                                                    'print_result' => false
                                                                   )
                                                            );
                        $month_result .= '</select>';
                }

                if ($this->display_days)
                {
                        $days = array();
                        if (isset($this->day_empty))
                        {
                                $days[''] = $this->day_empty;
                                $day_values[''] = '';
                        }
                        for ($i = 1; $i <= 31; $i++)
                        {
                                $days[] = sprintf($this->day_format, $i);
                                $day_values[] = sprintf($this->day_value_format, $i);
                        }

                        $day_result .= '<select name=';
                        if (null !== $this->field_array)
                        {
                                $day_result .= '"' . $this->field_array . '[' . $this->prefix . 'Day]"';
                        }
                        else
                        {
                                $day_result .= '"' . $this->prefix . 'Day"';
                        }

                        if (null !== $this->day_size)
                        {
                                $day_result .= ' size="' . $this->day_size . '"';
                        }

                        if (null !== $this->all_extra)
                        {
                                $day_result .= ' ' . $this->all_extra;
                        }

                        if (null !== $this->day_extra)
                        {
                                $day_result .= ' ' . $this->day_extra;
                        }
                        $day_result .= '>'."\n";
                        $day_result .= $this->html_options(array('output'     => $days,
                                                          'values'     => $day_values,
                                                          'selected'   => $this->time[2],
                                                          'print_result' => false)
                                                    );
                        $day_result .= '</select>';
                }
                
                if ($this->display_years)
                {
                        if (null !== $this->field_array)
                        {
                                $year_name = $this->field_array . '[' . $this->prefix . 'year]';
                        }
                        else
                        {
                                $year_name = $this->prefix . 'year';
                        }

                        if ($this->year_as_text)
                        {
                                $year_result .= '<input type="text" name="' . $year_name . '" value="' . $this->time[0] . '" size="4" maxlength="4"';
                                if (null !== $this->all_extra)
                                {
                                        $year_result .= ' ' . $this->all_extra;
                                }
                                if (null !== $this->year_extra)
                                {
                                        $year_result .= ' ' . $this->year_extra;
                                }
                                $year_result .= ' />';
                        }
                        else
                        {
                                $years = range((int)$this->start_year, (int)$this->end_year);
                                if ($this->reverse_years)
                                {
                                        rsort($years, SORT_NUMERIC);
                                }
                                else
                                {
                                        sort($years, SORT_NUMERIC);
                                }

                                $yearvals = $years;
                                if(isset($this->year_empty))
                                {
                                        array_unshift($years, $this->year_empty);
                                        array_unshift($yearvals, '');
                                }
                                
                                $year_result .= '<select name="' . $year_name . '"';
                                if (null !== $this->year_size)
                                {
                                        $year_result .= ' size="' . $this->year_size . '"';
                                }

                                if (null !== $this->all_extra)
                                {
                                        $year_result .= ' ' . $this->all_extra;
                                }

                                if (null !== $this->year_extra)
                                {
                                        $year_result .= ' ' . $this->year_extra;
                                }

                                $year_result .= '>'."\n";
                                $year_result .= $this->html_options(array('output' => $years,
                                                               'values' => $yearvals,
                                                               'selected'   => $this->time[0],
                                                               'print_result' => false)
                                                         );
                                $year_result .= '</select>';
                        }
                }

                // Loop thru the field_order field
                for ($i = 0; $i <= 2; $i++)
                {
                        $c = substr($this->field_order, $i, 1);
                        switch ($c)
                        {
                                case 'D': $html_result .= $day_result; break;
                                case 'M': $html_result .= $month_result; break;
                                case 'Y': $html_result .= $year_result; break;
                        }
                        // Add the field seperator
                        if($i != 2)
                        {
                                $html_result .= $this->field_separator;
                        }
                }
                echo $html_result;
        }

        protected function make_timestamp($string)
        {
                if(empty($string))
                {
                        // use "now":
                        $time = time();
                }
                elseif (preg_match('/^\d{14}$/', $string))
                {
                        // it is mysql timestamp format of YYYYMMDDHHMMSS?
                        $time = mktime(substr($string, 8, 2),substr($string, 10, 2),substr($string, 12, 2),
                                       substr($string, 4, 2),substr($string, 6, 2),substr($string, 0, 4));

                }
                elseif(is_numeric($string))
                {
                        // it is a numeric string, we handle it as timestamp
                        $time = (int)$string;
                }
                else
                {
                        // strtotime should handle it
                        $time = strtotime($string);
                        if ($time == -1 || $time === false)
                        {
                                // strtotime() was not able to parse $string, use "now":
                                $time = time();
                        }
                }
                return $time;
        }

        protected function html_options($params)
        {
                $name = null;
                $values = null;
                $options = null;
                $selected = array();
                $output = null;

                $extra = '';

                foreach($params as $_key => $_val)
                {
                        switch($_key)
                        {
                                case 'name': $$_key = (string)$_val; break;
                                case 'options': $$_key = (array)$_val; break;

                                case 'values':
                                case 'output': $$_key = array_values((array)$_val);  break;
                                
                                case 'selected': $$_key = array_map('strval', array_values((array)$_val)); break;

                                default:
                                        if(!is_array($_val))
                                        {
                                                //$extra .= ' '.$_key.'="'.quicky_function_escape_special_chars($_val).'"';
                                                $extra .= ' '.$_key.'="'.$_val.'"';
                                        }
                                        else
                                        {
                                                throw new CException("html_options: extra attribute ".$_key." cannot be an array");
                                        }
                                        break;
                        }
                }

                if (!isset($options) && !isset($values)) return ''; /* raise error here? */

                $_html_result = '';

                if (isset($options))
                {
                        foreach ($options as $_key=>$_val)
                        $_html_result .= $this->html_options_optoutput($_key, $_val, $selected);
                }
                else
                {
                        foreach ($values as $_i=>$_key)
                        {
                                $_val = isset($output[$_i]) ? $output[$_i] : '';
                                $_html_result .= $this->html_options_optoutput($_key, $_val, $selected);
                        }
                }

                if(!empty($name))
                {
                        $_html_result = '<select name="' . $name . '"' . $extra . '>' . "\n" . $_html_result . '</select>' . "\n";
                }
                
                return $_html_result;
        }

        protected function html_options_optoutput($key, $value, $selected)
        {
                if(!is_array($value))
                {
                        //$_html_result = '<option label="' . quicky_function_escape_special_chars($value) . '" value="' .quicky_function_escape_special_chars($key) . '"';
                        $_html_result = '<option label="' . $value . '" value="' .$key . '"';
                        if (in_array((string)$key, $selected))
                                $_html_result .= ' selected="selected"';

                        //$_html_result .= '>' . quicky_function_escape_special_chars($value) . '</option>' . "\n";
                        $_html_result .= '>'.$value. '</option>' . "\n";
                }
                else
                {
                        $_html_result = $this->html_options_optgroup($key, $value, $selected);
                }
                return $_html_result;
        }

        protected function html_options_optgroup($key, $values, $selected)
        {
                //$optgroup_html = '<optgroup label="' . quicky_function_escape_special_chars($key) . '">' . "\n";
                $optgroup_html = '<optgroup label="' . $key . '">' . "\n";
                foreach ($values as $key => $value)
                {
                        $optgroup_html .= $this->html_options_optoutput($key, $value, $selected);
                }
                $optgroup_html .= "</optgroup>\n";
                return $optgroup_html;
        }

}