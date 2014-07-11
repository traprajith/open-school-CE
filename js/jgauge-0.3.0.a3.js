/*!
 * jGauge v0.3.0 Alpha 3
 * http://www.jgauge.com/
 * Date: 03 March 2011
 *
 * Copyright 2010-2011, Darian Cabot
 * Licensed under the MIT license
 * http://www.jgauge.com/#licence
 */


/*
 * CHANGE LOG: VERSION 0.3.0 ALPHA 3:
 * ====================================
 *
 *  - Added automatic 'SI/binary prefix' option for k, M, G, etc...
 *
 *  - Added SI/binary prefix support for gauge auto-ranging.
 *
 *  - Added auto-update off CSS from jGauge size settings.
 *
 *  - Added label and ticks.label color setting.
 *
 *  - Fixed findUpperLimit bug (not rounding value up).
 *
 *  - Fixed tick values and needle position when tick.start isn't 0 (zero).
 *
 *  - Fixed needle z-index issue.
 *
 *  - jGauge internals are more object oriented.
 *
 *  - All spelling for functions, vars, etc. changed to American-English from
 *    Australian-English. This is to follow the general code standards and
 *    avoid confusion.
 *
 * CHANGE LOG: VERSION 0.3.0 ALPHA 2:
 * ====================================
 *
 *  - Angles now referenced with 0deg to the right (not to the top). This is the
 *    more common standard.
 *
 *  - Defined 'jG' as base state for 'this' making code simpler and improving 
 *    readability.
 *
 *  - Fixed canvas element sizing. Now done through DOM, not CSS which never
 *    worked. This was only noticeable in gauges larger than 300x150 (the canvas
 *    element's default size).
 *    See: http://www.whatwg.org/specs/web-apps/current-work/#the-canvas-element
 *
 *  - All offsets now relative to gauge center point (not upper left corner).
 *    This has made positioning elements more intuative for a dial/circle gauge.
 *
 *  - Finished the .updateRange() function.
 *
 *  - Created the .resetLayers() function to tidy up after gauge changes that
 *    would otherwise bring the modified layer to front causing design problems.
 *
 *  - Consolidated number precision operations into a new .numberPrecision()
 *    function to eliminate code doubling-up.
 *
 *  - The .findUpperLimit() function has been simplified and now allows for a
 *    'multiple' to be specified to round up to.
 *
 *  - Made use of the .getHiddenDimensions() plugin to correctly layout label 
 *    elements during initialisation even if the jGauge (or parent) is hidden.
 *
 *  - Various other code tweaks.
 *
 * KNOWN ISSUES:
 * =============
 *
 *  - Canvas not working in Internet Explorer (ticks and range) despite 
 *    excanvas.min.js.
 *
 *  - Updating range after initialisation renders arc as black 100% opacity
 *    I've seen this behaviour in Chrome 7.0 and Safari.
 *
 *  - The limitAction only works for the upper bounds, not lower bounds.
 *
 *  - Upon first load (not cached) and using .setValue() for the first time
 *    after .initialize(), the needle animates from 0deg (right-side), not from
 *    the .tickStart value (usually left-side) as it should.
 *
 */


// Global vars...

// Expose the Limit Action Enum globally...
var limitAction = 
{
        spin: 0,
        clamp: 1,
        autoRange: 2
};

var autoPrefix = 
{
        none: 0, // No SI or binary prefixing, normal comma segmented number.
        si: 1, // SI prefixing (i.e. 1000^n) used for SI units / metric.
        binary: 2 // Binary prefixing (i.e. 1024^n) used for computer units.
};

function jGauge()
{
        // Define var of current 'this' state (helps prevent 'this' abuse).
        var jG = this;
        
        jG.version = '0.3.0.3'; // Major, minor, fix, release.
        
        jG.centerX = 0; // Internal use for positioning elements.
        jG.centerY = 0; // Internal use for positioning elements.
        
        // DEFAULT PARAMETERS FOR jGAUGE...
        jG.id = ''; // Default: nothing. Must be unique per jGauge instance.
        jG.segmentStart = -200; // Relative to 0deg (3-o-clock position).
        jG.segmentEnd = 20; // Relative to 0deg (3-o-clock position).
        jG.imagePath = 'images/jgauge_face_default.png'; // Background image path.
        jG.width = 160; // Total width of jGauge.
        jG.height = 114; // Total height of jGauge.
        jG.showAlerts = false; // Show error alerts? Useful when debugging.
        
        jG.autoPrefix = autoPrefix.si; // Automatically assigns prefix on label when approapriate (after value, before suffix) i.e. k, M, G, etc.
        
        jG.siPrefixes = ['', 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y'];
        jG.binaryPrefixes = jG.siPrefixes;
        
        // Define the jGauge.needle object...
        function needle()
        {
                var ndl = this;
                ndl.imagePath = 'images/jgauge_needle_default.png'; // Needle image path.
                ndl.limitAction = limitAction.autoRange; // What to do when the needle hits the limit.
                ndl.xOffset = 0; // Shift needle position horizontally from center.
                ndl.yOffset = 24; // Shift needle position vertically from center.
        }
        
        // Add the needle object to the jGauge object.
        jG.needle = new needle();
        
        // Define the jGauge.label object...
        function label()
        {
                var lbl = this;
                lbl.color = '#144b66'; // Text color applied as CSS.
                lbl.precision = 1; // Value label rounding decimal places.
                lbl.prefix = ''; // Prefix for the value label (i.e. '$').
                lbl.suffix = ''; // Suffic for the value label (i.e. '&deg;C')
                lbl.xOffset = 0; // Shift label horizontally from center.
                lbl.yOffset = 20; // Shift label vertically from center.
        }
        
        // Add the label object to the jGauge object.
        jG.label = new label();
        
        // Define the jGauge.label object...
        function ticks()
        {
                var tks = this;
                tks.count = 11; // Number of tick marks around the gauge face.
                tks.start = 0; // Value of the first tick mark.
                tks.end = 10; // Value of the last tick mark.
                tks.color = 'rgba(255, 255, 255, 1)'; // Tick mark color.
                tks.thickness = 3; // Tick mark thickness.
                tks.radius = 76; // Tick mark radius (from gauge center point).
                tks.labelPrecision = 1; // Rounding decimals for tick labels.
                tks.labelRadius = 63; // Tick label radius (from gauge center).
                tks.labelColor = '#327a9e'; // Text color applied as CSS.
        }
        
        // Add the ticks object to the jGauge object.
        jG.ticks = new ticks();
        
        function range()
        {
                var rng = this;
                rng.radius = 55; // Range arc radius (from gauge center).
                rng.thickness = 36; // Range arc thickness (spread of the arc outwards).
                rng.start = -24; // Range start point as an angle relative to 0deg (pointing right).
                rng.end = 25; // Range end point as an angle relative to 0deg (pointing right).
                rng.color = 'rgba(255, 32, 0, 0.2)'; // Color and alpha (opacity) of the range arc.
        }
        
        jG.range = new range();
        
        jG.value = 0;
        
        // Function calls...
        jG.init = init; // Initialises the gauge and puts it on the page.
        jG.setValue = setValue; // Sets or updates the gauge value.
        jG.getValue = getValue; // Gets the current gauge value.
        jG.updateTicks = updateTicks; // Updates the tick marks and tick labels (call after changing tick parameters).
        jG.updateRange = updateRange; // Updates the range (call after changing range parameters).
        jG.resetLayers = resetLayers; // Puts all jGauge elements in the correct order. Intended for internal use.
        jG.prefixNumber = prefixNumber; // Modifies number to SI/binary prefixing (i.e. 5000 becomes 5k).


	/**
	 * Initialises the gauge.
	 * This creates the gauge and placing it on the page ready for use.
	 * @author Darian Cabot
	 */
        function init()
        {
                var labelCssLeft;  // For horizontally positioning label.
                var labelCssTop;   // For vertically positioning label.
                var needleCssLeft; // For horizontally positioning needle.
                var neeldeCssTop;  // For vertically positioning needle.
                
                // Find center of the gauge for positioning reference...
                // TODO: Verify the .gaugeWidth with the placeholder DIV width (same for height).
                jG.centerX = jG.width / 2;
                jG.centerY = jG.height / 2;
                
                // Update gauge CSS with set jGauge dimensions.
                $('#' + jG.id).css({'width': jG.width, 'height': jG.height});
                
                // Wipe the slate clean in case gauge already initialized.
                $('#' + jG.id).children().remove();
                
                // Add the background image.
                $('#' + jG.id).css('background-image', 'url("' + jG.imagePath + '")');
                
                // Create the range arcs and put them on the gauge.
                jG.updateRange();
                
                // Create the ticks and put them on the gauge.
                jG.updateTicks();
                
                // Add the main label...
                htmlString = '<p id="' + jG.id + '-label" class="label">' + 
                        jG.label.prefix + '<strong>' + jG.ticks.start + 
                        '</strong>' + jG.label.suffix + '</p>';
                        
                $('#' + jG.id).append(htmlString);
                
                // Position the main label...
                labelCssLeft = Math.round(jG.centerX - $('#' + jG.id + '-label').getHiddenDimensions().w / 2 + jG.label.xOffset) + 'px';
                labelCssTop = Math.round(jG.centerY - $('#' + jG.id + '-label').getHiddenDimensions().h / 2 + jG.label.yOffset) + 'px';
                $('#' + jG.id + '-label').css({'left': labelCssLeft, 'top': labelCssTop});
                
                // Apply label color...
                $('#' + jG.id + ' .label').css('color', jG.label.color);
                
                
                // Label created, so reveal it.
                $('#' + jG.id + '-label').fadeIn('slow');
                
                
                // Add the needle...
                htmlString = '<img id="' + jG.id + '-needle" class="needle" src="' + jG.needle.imagePath + '" />';
                $('#' + jG.id).append(htmlString);
                
                $('#' + jG.id + '-needle').load(function() {
                        // Position needle once it's done loading...
                        needleCssLeft = Math.round(jG.centerX - ($('#' + jG.id + '-needle').getHiddenDimensions().w / 2) + jG.needle.xOffset) + 'px';
                        neeldeCssTop = Math.round(jG.centerY - ($('#' + jG.id + '-needle').getHiddenDimensions().h / 2) + jG.needle.yOffset) + 'px';
                        $('#' + jG.id + '-needle').css({'left': needleCssLeft, 'top': neeldeCssTop});
                });
                
                // Needle created, so reveal it.
                $('#' + jG.id + '-needle').fadeIn('slow');
                
                // Ensure everything's in the correct order.
                jG.resetLayers();
                
                // Set the needle to the lowest value.
                // This is initially run TWICE to stop an animation glitch.
                // If it's run only once, the next value will be animated from the needle in
                // the 3-o-clock position even though it should come from it's initial position.
                // I'll look into this further soon but it *may* be caused by jQueryRotate?
                jG.setValue(jG.ticks.start);
                jG.setValue(jG.ticks.start);
        }


	/**
	 * Puts all of the jGauge elements in the correct order.
	 * This is required because updating a single canvas layer was bringing
	 * that layer to top messing up the design.
	 * @author Darian Cabot
	 */
	function resetLayers()
	{
		$('#' + jG.id).css('z-index', 0);
		$('#' + jG.id + '-canvas-ranges').css('z-index', 1);
		$('#' + jG.id + '-canvas-ticks').css('z-index', 2);
		$('#' + jG.id + ' .tick-label').css('z-index', 3);
		$('#' + jG.id + '-label').css('z-index', 4);
		$('#' + jG.id + '-needle').css('z-index', 5); // This one doesn't work (overwritten by jQueryRotate??).
	}
	
	
	/**
	 * Creates the range arcs on the gauge face.
	 * @author Darian Cabot
	 */
	function updateRange()
	{
	        var canvas; // The canvas used for the range.
	        var ctx; // The 2D convas context for drawing.
	        
		// Remove any existing ticks canvas.
		$('#' + jG.id + '-canvas-ranges').remove();
		
		// Create range arcs by drawing on a new canvas...
		htmlString =  '<canvas id="' + jG.id + '-canvas-ranges"></canvas>';
		$('#' + jG.id).append(htmlString);
		
		// Reference the canvas element we just created.
		canvas = document.getElementById(jG.id + '-canvas-ranges');
		
		// Resize canvas...
		canvas.width = jG.width;
		canvas.height = jG.height;
		
		// Make sure we don't execute when canvas isn't supported.
		if (canvas.getContext)
		{
			// Use getContext to use the canvas for drawing.
			ctx = canvas.getContext('2d');
			
			ctx.strokeStyle = jG.range.color;
			ctx.lineWidth = jG.range.thickness;
			
			ctx.beginPath();
			
			// The canvas arc parameters are as follows:...
			// arc(x, y, radius, startAngle, endAngle, anticlockwise).
			ctx.arc(jG.centerX + jG.needle.xOffset, 
				jG.centerY + jG.needle.yOffset, 
				jG.range.radius, 
				(Math.PI / 180) * jG.range.start, 
				(Math.PI / 180) * jG.range.end, 
				false);
			
			// Draw range arc on canvas.
			ctx.stroke();
			jG.resetLayers();
		}
		else
		{
			// Canvas not supported!
			
			/* @TODO: alert() is a bit blunt, some other notification
			 * should be used instead.
			 */
			
			if (jG.showAlerts === true)
			{
				alert('Sorry, canvas is not supported by your browser!');
			}
		}
	}
	
	
	/**
	 * Creates the tick marks and labels on the gauge face.
	 * @author Darian Cabot
	 */
	function updateTicks()
	{
		var gaugeSegmentStep;
		var htmlString;
		var canvas;
		var ctx;
		var startAngle;
		var endAngle;
		var tickStep;
		
                var leftOffset;
                var topOffset;
                var tickLabelCssLeft;
                var tickLabelCssTop;
		
		// FIRST: Draw ticks on gauge...
		
		// Remove any existing ticks canvas.
		$('#' + jG.id + '-canvas-ticks').remove();
		
		// Check if there is actually anything to draw...
		if (jG.ticks.count !== 0 || jG.ticks.thickness !== 0)
		{
			// Create ticks by drawing on a canvas...
			htmlString = '<canvas id="' + jG.id + '-canvas-ticks"></canvas>';
			$('#' + jG.id).append(htmlString);
			
			// Reference the canvas element we just created.
			canvas = document.getElementById(jG.id + '-canvas-ticks');
			
			// Resize canvas...
			canvas.width = jG.width;
			canvas.height = jG.height;

			// Make sure we don't execute when canvas isn't supported
			if (canvas.getContext)
			{
				// use getContext to use the canvas for drawing
				ctx = canvas.getContext('2d');
				
				// Draw ticks
				gaugeSegmentStep = Math.abs(jG.segmentStart - jG.segmentEnd) / (jG.ticks.count - 1);
				ctx.strokeStyle = jG.ticks.color;
				ctx.lineWidth = 5;
				
				for (i = 0; i <= jG.ticks.count - 1; i ++)
				{
					startAngle = (Math.PI / 180) * (jG.segmentStart + (gaugeSegmentStep * i) - (jG.ticks.thickness / 2));
					endAngle = (Math.PI / 180) * (jG.segmentStart + (gaugeSegmentStep * i) + (jG.ticks.thickness / 2));
					
					ctx.beginPath();
					
					ctx.arc(jG.centerX + jG.needle.xOffset, 
						jG.centerY + jG.needle.yOffset, 
						jG.ticks.radius, 
						startAngle, 
						endAngle, 
						false);
					
					ctx.stroke();
				}
				jG.resetLayers();
			}
			else
			{
				// Canvas not supported!
				
				/* @TODO: alert() is a bit blunt, some other notification
				 * should be used instead.
				 */
				 
				if (jG.showAlerts === true)
				{
					alert('Sorry, canvas is not supported by your browser!');
				}
			}
		}
		
		
		// THIRD: Place tick labels on gauge...
		
		// Remove the existing tick labels.
		$('#' + jG.id + ' .tick-label').remove();
		
		// Check if there is actually anything to draw...
		if (jG.tickCount !== 0)
		{
			// Calculate the step value between each tick.
			tickStep = (jG.ticks.end - jG.ticks.start) / (jG.ticks.count - 1);
			gaugeSegmentStep = Math.abs(jG.segmentStart - jG.segmentEnd) / (jG.ticks.count - 1);

			for (i = 0; i <= jG.ticks.count - 1; i ++)
			{
				// Calculate the tick value, round it, stick it in html...
				//var htmlString = '<p class="tick-label">' + addCommas(numberPrecision((i * tickStep), jG.ticks.labelPrecision)) + '</p>';
				htmlString = '<p class="tick-label">' + prefixNumber(jG.ticks.start + i * tickStep, false) + '</p>';
				
				
				// Add the tick label...
				$('#' + jG.id).append(htmlString);
				
				// Calculate the position of the tick label...
				leftOffset = jG.centerX + jG.needle.xOffset - $('#' + jG.id + ' .tick-label').getHiddenDimensions().w / 2;
				topOffset = jG.centerY + jG.needle.yOffset - $('#' + jG.id + ' .tick-label').getHiddenDimensions().h / 2;
				tickLabelCssLeft = Math.round((jG.ticks.labelRadius * Math.cos((jG.segmentStart + (i * gaugeSegmentStep)) * Math.PI / 180)) + leftOffset) + 'px';
				tickLabelCssTop = Math.round(jG.ticks.labelRadius * Math.sin(Math.PI / 180 * (jG.segmentStart + (i * gaugeSegmentStep))) + topOffset) + 'px';
				
				$('#' + jG.id + ' p:last').css({'left': tickLabelCssLeft, 'top': tickLabelCssTop});
			}

                        // Apply label color...
                        $('#' + jG.id + ' .tick-label').css('color', jG.ticks.labelColor);
                        
			// Tick labels are all created, so reveal them together.
			$('#' + jG.id + ' .tick-label').fadeIn('slow');
		}
	}


	/**
	 * Changes the gauge value (needle and read-out label).
	 * The gauge must be initialized with createGauge() before this is called.
	 * @author Darian Cabot
	 * @param {Number} newValue The new value for the gauge.
	 */
	function setValue(newValue)
	{
	        var degreesMult;
	        var valueDegrees;
	        var htmlString;
	        var needleCssLeft;
	        var needleCssTop;
	        
		// First set the internal value variable (so we can return if required).
		jG.value = newValue;
		
		// Scale the 'value' to 'degrees' around the gauge.
		degreesMult = (jG.segmentEnd - jG.segmentStart) / (jG.ticks.end - jG.ticks.start);
		valueDegrees = degreesMult * (newValue - jG.ticks.start);

		// Check the needle is in bounds...
		// TODO: This is only checking the upper limit, we should also be checking the lower limit.
		if (valueDegrees > Math.abs(jG.segmentStart - jG.segmentEnd))
		{
			if (jG.needle.limitAction === limitAction.autoRange)
			{
                                jG.ticks.end = findUpperLimit(newValue, 10);
                                jG.updateTicks();
                                // TODO: update range also (range should be set with gauge values, not degress).

                                // Scale the 'value' to 'degrees' around the gauge AGAIN.
                                valueDegrees = newValue * (jG.segmentEnd - jG.segmentStart) / (jG.ticks.end - jG.ticks.start);
			}
			else if (jG.needle.limitAction === limitAction.clamp)
			{
                                // Clamp needle to gauge limit (stops the needle spinning).
                                valueDegrees = Math.abs(jG.segmentStart - jG.segmentEnd);

                                // Shake the needle to simulate bouncing off the limit...
                                // TODO: wait until needle finished moving before 'bouncing'.
                                $('#' + jG.id + '-needle')
                                        .animate({ top: '+=2', left: '-=2' }, 50)
                                        .animate({ top: '-=2', left: '+=2' }, 50)
                                        .animate({ top: '+=2', left: '-=2' }, 50)
                                        .animate({ top: '-=2', left: '+=2' }, 50);
			}
		}
		
		// Rotate the needle...
		$('#' + jG.id + '-needle').rotateAnimation(jG.segmentStart + valueDegrees);
		$('#' + jG.id + '-needle').css('position', 'absolute'); // This *MUST* be set after image-rotation!
		
		// Reposition needle (sometimes the needle moves off axis - witnessed in Firefox 3.6)...
		needleCssLeft = Math.round(jG.centerX - $('#' + jG.id + '-needle').width() / 2 + jG.needle.xOffset) + 'px';
		needleCssTop = Math.round(jG.centerY - $('#' + jG.id + '-needle').height() / 2 + jG.needle.yOffset) + 'px';
		$('#' + jG.id + '-needle').css({'left': needleCssLeft, 'top': needleCssTop});
		
		// Build the label string (and apply any SI / binary prefix)...
		htmlString = prefixNumber(newValue, true);
		
		// Update label value...
		$('#' + jG.id + '-label').html(htmlString);
	}
	
	
	/**
	 * Gets the gauge value.
	 * @returns The current gauge value.
	 * @type Number
	 */
	function getValue()
	{
		return this.value;
	}
	
	
	/**
	 * Returns a SI / binary prefixed string from a number.
	 * @author Darian Cabot
	 * @param {Number} value A number to be rounded.
	 * @param {Boolean} formatting Whether to include prefix/suffix and bold value (usually true for gauge label and false for tick labels).
	 * @returns the SI/binary prefixed number as a string (i.e. 2500 becomes 2.5k).
	 * @type String
	 */
	function prefixNumber(value, formatting)
	{
		var power = 0;
		var prefix = '';
		
		switch (jG.autoPrefix)
		{
			case autoPrefix.si:
				
				while (value >= 1000)
				{
					power ++;
					value /= 1000;
				}
				
				prefix = jG.siPrefixes[power];
				
				break;
			
			case autoPrefix.binary:
				
				while (value >= 1024)
				{
					power ++;
					value /= 1024;
				}
				
				prefix = jG.binaryPrefixes[power];
				
				break;
		}
		
		// Build the label string (and apply any SI / binary prefix)...
		if (formatting === true)
		{
			return jG.label.prefix + '<strong>' + addCommas(numberPrecision(value, jG.label.precision)) + '</strong> ' + prefix + jG.label.suffix;
		}
		else
		{
			return addCommas(numberPrecision(value, jG.label.precision)) + prefix;
		}
	}
	
	
	/**
	 * Returns an upper limit (range) based on the value and multiple.
	 * It rounds the value up the the closest multiple.
	 * TODO: Factor in the number of ticks and avoid wierd decimal values for ticks.
	 * @author Darian Cabot
	 * @param {Number} value The gauge value that the range is to be suited to.
	 * @param {Number} multiple The multiple to round up to.
	 * @returns the closest multiple above the value.
	 * @type Number
	 */
	function findUpperLimit(value, multiple)
	{
		
		//return Math.ceil(Math.ceil(value) / multiple) * multiple; // Old method (prior to SI/binary prefixing).
		
		var power = 0;
		var bump = 0;
		
		if (jG.autoPrefix === autoPrefix.binary)				
		{
			// Special case for binary mode...
			
			while (value >= 2)
			{
				power ++;
				value /= 2;
			}
			
			return Math.pow(2, power + 1);
		}
		else
		{
			multiple /= 10;
			
			while (value >= 10)
			{
				power ++;
				value /= 10;
			}
			
			while (value > bump)
			{
				bump += multiple;
			}
			
			// parseInt is used to ensure there aren't any wierd float decimals (i.e. 4.999~ instead of 5).
			return parseInt(bump * Math.pow(10, power), 10);
		}
	}
	
}


// Helper functions...

/**
 * Returns a rounded number to the precision specified.
 * @author Darian Cabot
 * @param {Number} value A number to be rounded.
 * @param {Number} decimals The number of decimal places to round to.
 * @returns the value rounded to the number of decimal places specified.
 * @type Number
 */
numberPrecision = function(value, decimals)
{
	return Math.round(value * Math.pow(10, decimals)) / Math.pow(10, decimals);
};


/**
 * Formats a numeric string by adding commas for cosmetic purposes.
 * @author Keith Jenci
 * @see http://www.mredkj.com/javascript/nfbasic.html
 * @param {String} nStr A number with or without decimals.
 * @returns a nicely formatted number.
 * @type String
 */
addCommas = function(nStr)
{
	nStr += '';
	var x = nStr.split('.');
	var x1 = x[0];
	var x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	
	while (rgx.test(x1))
	{
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
};


(function($)
{
	$.fn.getHiddenDimensions = function(boolOuter)
	{
		var $item = this;
		var props = { position: 'absolute', visibility: 'hidden', display: 'block' };
		var dim = { 'w':0, 'h':0 };
		var $hiddenParents = $item.parents().andSelf().not(':visible');
		
		var oldProps = [];
		$hiddenParents.each(function()
		{
			var old = {};
			
			for (var name in props)
			{
				old[ name ] = this.style[ name ];
				this.style[ name ] = props[ name ];
			}
			
			oldProps.push(old);
		});
		
		if (!false === boolOuter)
		{
			dim.w = $item.outerWidth();
			dim.h = $item.outerHeight();
		}
		else
		{
			dim.w = $item.width();
			dim.h = $item.height();
		}
		
		$hiddenParents.each(function(i)
		{
			var old = oldProps[i];
			for (var name in props)
			{
				this.style[ name ] = old[ name ];
			}
		});
		
		return dim;
	};
}(jQuery));

