<?php

define('MEMORY_TO_ALLOCATE',	'100M');



 /**
 * Resize image
 *  - provide crop to square size image
 *  - provide 4 corner to create round corner image (advanced) 
 */
 
 class ImageResizer
 {
	 private $sourceFolder = '';
	 private $sourceName = '';
	 private $destFolder = '';
	 private $destName = '';
	 private $maxWidth = 0;
	 private $maxHeight = 0;
	 private $cropRatio = '';
	 private $watermarkFile = '';
	 private $watermarkPosition = 'topleft'; //eight position
	 private $watermarkPadding = array('top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0);
	 private $corner = false;
	 private $cornerImages = array();
	 private $size = array();
	 private $quality = 90;
	 private $color = '';
	 public $file_error = false;
	 
	 
	 /**
	 * Construction for class 
	 * 
	 * @param string $sourceFolder : end with slash '/'
	 * @param string $sourceName
	 * @param string $destFolder : end with slash '/'
	 * @param string $destName
	 * @param int $maxWidth
	 * @param int $maxHeight
	 * @param string $cropRatio
	 * @param int $quality
	 * @param string $color
	 * 
	 * @return ImageResizer
	 */
	 function __construct($sourceFolder, $sourceName, $destFolder, $destName, $maxWidth = 0, $maxHeight = 0, $cropRatio = '', $quality = 90, $color = '')
	 {
		$this->sourceFolder = $sourceFolder;
		$this->sourceName = $sourceName;
		$this->destFolder = $destFolder;
		$this->destName = $destName;
		$this->maxWidth = $maxWidth;
		$this->maxHeight = $maxHeight;
		$this->cropRatio = $cropRatio;
		$this->quality = $quality;
		$this->color = $color;
		
		$klog = new KLogger(Yii::getPathOfAlias('common.log').DIRECTORY_SEPARATOR.'resize_image_log', KLogger::INFO);
		if (!file_exists($this->sourceFolder . $this->sourceName))
		{
			echo 'Error: image does not exist: ' . $this->sourceFolder . $this->sourceName;
			$this->file_error=true;
			$klog->LogInfo('Error: image does not exist: ' . $this->sourceFolder . $this->sourceName);
			return null;
		}
		
		$size	= GetImageSize($this->sourceFolder . $this->sourceName);
		$mime	= $size['mime'];
		// Make sure that the requested file is actually an image
		if (substr($mime, 0, 6) != 'image/')
		{
			echo 'Error: requested file is not an accepted type: ' . $this->sourceFolder . $this->sourceName;
			$klog->LogInfo('Error: requested file is not an accepted type: ' . $this->sourceFolder . $this->sourceName);
			$this->file_error=true;
			return null;           
		}
		$this->size = $size;
		
		if ($color != '')
			$this->color = preg_replace('/[^0-9a-fA-F]/', '', $color);
		else
			$this->color		= FALSE;
	 }
	 
	 /**
	 * Assign watermark to output image
	 * 
	 * @param string $watermarkFile
	 * @param string $watermarkPosition
	 * @param string/array $watermarkPadding
	 */
	 public function addWatermark($watermarkFile, $watermarkPosition = '', $watermarkPadding = '')
	 {
		 $this->watermarkFile = $watermarkFile;
		 
		 if(in_array($watermarkPosition, array('center', 'topleft', 'topcenter', 'topright', 'rightmiddle', 'bottomright', 'bottomcenter', 'bottomleft', 'leftmiddle')))
			$this->watermarkPosition = $watermarkPosition;
		
		 if(is_array($watermarkPadding))
			$this->watermarkPadding = $watermarkPadding; 
		 else if(strlen($watermarkPadding) > 0)
		 {
			$paddingArray = split(',', $watermarkPadding);
			if(isset($paddingArray[0])) $this->watermarkPadding['top'] = (int)($paddingArray[0]);	 
			if(isset($paddingArray[1])) $this->watermarkPadding['right'] = (int)($paddingArray[1]);	 
			if(isset($paddingArray[2])) $this->watermarkPadding['bottom'] = (int)($paddingArray[2]);	 
			if(isset($paddingArray[3])) $this->watermarkPadding['left'] = (int)($paddingArray[3]);	 
		 }
	 }
	 
	 /**
	 * Assign corner image to 4 corners of image
	 * 
	 * @param array $cornerImages : assoc array ('topleft' => PNG image, 'topright' => PNG image, 'bottomright' => PNG image, 'bottomleft' => PNG image) 
	 */
	 public function addCorner($cornerImages = array())
	 {
		 $this->corner = true;
		 $this->cornerImages = $cornerImages;
	 }
	 
	 /**
	 * Set the quality of the output image
	 * 
	 * @param mixed $quality
	 */
	 public function setQuality($quality = 90)
	 {
		 $this->quality = $quality;
	 }
	 
	 
	 
	 /**
	 * Output the image
	 * 
	 * @param boolean $save : If true: save image to selected destFolder and destName, otherwise, output image to browser with encoding of image
	 */
	 public function output($save = true)
	 {
		$width		= $this->size[0];
		$height		= $this->size[1];
		$mime       = $this->size['mime'];
		$color		= $this->color;
		
		 // If we don't have a max width or max height, OR the image is smaller than both
		// we do not want to resize it, so we simply output the original image and exit
		// Exection: in case caller want to add watermark only, still create new image...
		if (((!$this->maxWidth && !$this->maxHeight) || ($this->maxWidth >= $width && $this->maxHeight >= $height)) && $this->watermarkFile == '')
		{
			if($save)
			{
				copy($this->sourceFolder . $this->sourceName, $this->destFolder . $this->destName);
			}
			else
			{
				$data	= file_get_contents($this->sourceFolder . $this->sourceName);
				header("Content-type: ".$this->size['mime']."");
				header('Content-Length: ' . strlen($data));
				echo $data;
			}
		}
		else
		{
			//need to resize image
			// Ratio cropping
			$offsetX	= 0;
			$offsetY	= 0;

			if (strlen($this->cropRatio) > 0)
			{
				$cropRatio		= explode(':', $this->cropRatio);
				if (count($cropRatio) == 2)
				{
					$ratioComputed		= $width / $height;
					$cropRatioComputed	= (float) $cropRatio[0] / (float) $cropRatio[1];
					
					if ($ratioComputed < $cropRatioComputed)
					{ // Image is too tall so we will crop the top and bottom
						$origHeight	= $height;
						$height		= $width / $cropRatioComputed;
						$offsetY	= ($origHeight - $height) / 2;
					}
					else if ($ratioComputed > $cropRatioComputed)
					{ // Image is too wide so we will crop off the left and right sides
						$origWidth	= $width;
						$width		= $height * $cropRatioComputed;
						$offsetX	= ($origWidth - $width) / 2;
					}
				}
			}
			
			// Setting up the ratios needed for resizing. We will compare these below to determine how to
			// resize the image (based on height or based on width)
			$xRatio		= $this->maxWidth / $width;
			$yRatio		= $this->maxHeight / $height;

			if($xRatio > 1 && $yRatio > 1)
			{
				$tnWidth = $width;
				$tnHeight = $height;
			}
			else
			{
				if ($xRatio * $height < $this->maxHeight)
				{ // Resize the image based on width
					$tnHeight	= ceil($xRatio * $height);
					$tnWidth	= $this->maxWidth;
				}
				else
				{
					$tnWidth	= ceil($yRatio * $width);
					$tnHeight	= $this->maxHeight;
				}	
			}

			// Determine the quality of the output image
			$quality = $this->quality;
			
			// We don't want to run out of memory
			ini_set('memory_limit', MEMORY_TO_ALLOCATE);
			
			// Set up a blank canvas for our resized image (destination)
			$dst	= imagecreatetruecolor($tnWidth, $tnHeight);
			
			// Set up the appropriate image handling functions based on the original image's mime type
			switch ($this->size['mime'])
			{
				case 'image/gif':
					// We will be converting GIFs to PNGs to avoid transparency issues when resizing GIFs
					// This is maybe not the ideal solution, but IE6 can suck it
					$creationFunction	= 'ImageCreateFromGif';
					$outputFunction		= 'ImagePng';
					$mime				= 'image/png'; // We need to convert GIFs to PNGs
					$doSharpen			= FALSE;
					$quality			= round(10 - ($quality / 10)); // We are converting the GIF to a PNG and PNG needs a compression level of 0 (no compression) through 9
				break;
				
				case 'image/x-png':
				case 'image/png':
					$creationFunction	= 'ImageCreateFromPng';
					$outputFunction		= 'ImagePng';
					$doSharpen			= FALSE;
					$quality			= round(10 - ($quality / 10)); // PNG needs a compression level of 0 (no compression) through 9
				break;
				
				default:
					$creationFunction	= 'ImageCreateFromJpeg';
					$outputFunction		= 'ImageJpeg';
					$doSharpen			= TRUE;
				break;
			}
			
			//ini_set(‘gd.jpeg_ignore_warning’, 1);
			// Read in the original image
		
			//var_dump($this->sourceFolder . $this->sourceName);
			ini_set('gd.jpeg_ignore_warning', 1);
			$src	= @$creationFunction($this->sourceFolder . $this->sourceName);
			
		
			imagealphablending($src, true);
			
			if (in_array($this->size['mime'], array('image/gif', 'image/png')))
			{
				if (!$color)
				{
					// If this is a GIF or a PNG, we need to set up transparency
					imagealphablending($dst, true);
					imagesavealpha($dst, true);
				}
				else
				{
					// Fill the background with the specified color for matting purposes
					if ($color[0] == '#')
						$color = substr($color, 1);
					
					$background	= FALSE;
					
					if (strlen($color) == 6)
						$background	= imagecolorallocate($dst, hexdec($color[0].$color[1]), hexdec($color[2].$color[3]), hexdec($color[4].$color[5]));
					else if (strlen($color) == 3)
						$background	= imagecolorallocate($dst, hexdec($color[0].$color[0]), hexdec($color[1].$color[1]), hexdec($color[2].$color[2]));
					
					if ($background)
						imagefill($dst, 0, 0, $background);
				}
			}
			
			// Resample the original image into the resized canvas we set up earlier
			ImageCopyResampled($dst, $src, 0, 0, $offsetX, $offsetY, $tnWidth, $tnHeight, $width, $height);
			
			if ($doSharpen)
			{
				// Sharpen the image based on two things:
				//	(1) the difference between the original size and the final size
				//	(2) the final size
				$sharpness	= $this->findSharp($width, $tnWidth);
				
				$sharpenMatrix	= array(
					array(-1, -2, -1),
					array(-2, $sharpness + 12, -2),
					array(-1, -2, -1)
				);
				$divisor		= $sharpness;
				$offset			= 0;
				imageconvolution($dst, $sharpenMatrix, $divisor, $offset);
			}
			
			//process add watermark
			if($this->watermarkFile != '' && file_exists($this->watermarkFile))
			{
				$watermarkImage = imagecreatefrompng($this->watermarkFile);
				list($watermarkWidth, $watermarkHeight)=getimagesize($this->watermarkFile);
				
				imagealphablending($watermarkImage, true);
				imagesavealpha($watermarkImage, true);
				
				$dst_x = (int)($this->watermarkPadding['left']) - (int)($this->watermarkPadding['right']);
				$dst_y = (int)($this->watermarkPadding['top']) - (int)($this->watermarkPadding['bottom']);
				
				switch($this->watermarkPosition)
				{
					case 'center' :	$dst_x += (int)($tnWidth/2 - $watermarkWidth/2);
										$dst_y += (int)($tnHeight/2 - $watermarkHeight/2);
					break;
					
					case 'topleft' :	$dst_x += 0;
										$dst_y += 0;
					break;
					
					case 'topcenter' :	$dst_x += (int)($tnWidth/2 - $watermarkWidth/2);   
										$dst_y += 0;
					break;
					
					case 'topright' :	$dst_x += $tnWidth - $watermarkWidth;
										$dst_y += 0;
					break;
					
					case 'rightmiddle':	$dst_x += $tnWidth - $watermarkWidth;   
										$dst_y += (int)($tnHeight/2 - $watermarkHeight/2);
					break;
					
					case 'bottomright':	$dst_x += $tnWidth - $watermarkWidth;
										$dst_y += $tnHeight - $watermarkHeight;
					break;
					
					case 'bottomcenter':$dst_x += (int)($tnWidth/2 - $watermarkWidth/2);
										$dst_y += $tnHeight - $watermarkHeight;  
					break;
					
					case 'bottomleft':	$dst_x += 0;
										$dst_y += $tnHeight - $watermarkHeight;
					break;
					
					case 'leftmiddle' :	$dst_x += 0;
										$dst_y += (int)($tnHeight/2 - $watermarkHeight/2);
					break;
				}
				
				imagecopy($dst, $watermarkImage, $dst_x, $dst_y, 0, 0, $watermarkWidth, $watermarkHeight);
			}
			
			//process add corner to image
			if($this->corner)
			{
				foreach($this->cornerImages as $position=>$filenameCorner)
				{
					if(file_exists($filenameCorner))
					{
						list($cornerWidth, $cornerHeight)=getimagesize($filenameCorner);                      
						$corner = imagecreatefrompng($filenameCorner);
						
						$dst_x = 0;
						$dst_y = 0;
						switch($position)
						{
							case 'topleft' :	$dst_x = 0;
												$dst_y = 0;
							break;
							
							case 'topright' :	$dst_x = $tnWidth - $cornerWidth;
												$dst_y = 0;
							break;
							
							case 'bottomright':	$dst_x = $tnWidth - $cornerWidth;
												$dst_y = $tnHeight - $cornerHeight;
							break;
							
							case 'bottomleft':	$dst_x = 0;
												$dst_y = $tnHeight - $cornerHeight;
							break;
							
							
						}
						
						imagecopy($dst, $corner, $dst_x, $dst_y, 0, 0, $cornerWidth, $cornerHeight);	
					}
				}	
			}
			
			
			if($save)
			{
				if(!file_exists($this->destFolder))
					mkdir($this->destFolder, 0777, true);
				// Write the resized image to the destination 
				$outputFunction($dst, $this->destFolder . $this->destName, $quality);
			}
			else
			{
				//output image to browser
				header('Content-Type: ' . $mime);
				$outputFunction($dst, NULL, $quality);      
			}
			
			
		}
		
	 }
	 
	 
	 
	 private function findSharp($orig, $final) // function from Ryan Rud (http://adryrun.com)
	 {
		$final	= $final * (750.0 / $orig);
		$a		= 52;
		$b		= -0.27810650887573124;
		$c		= .00047337278106508946;
		
		$result = $a + $b * $final + $c * $final * $final;
		
		return max(round($result), 0);
	 } // findSharp()
	 
	  
 }
?>