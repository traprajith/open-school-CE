/* Swedish initialisation for the jQuery UI date picker plugin. */
/* Written by Henrik Engman (info@ehenrik.com). */

$.datepicker.regional['se'] = {
   closeText: 'Stäng',
   prevText: 'Tillbaka',
   nextText: 'Nästa;',
   currentText: 'Idag',
   monthNames: ['Januari','Februari','Mars','April','Maj','Juni',
   'Juli','Augusti','September','Oktober','November','December'],
   monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun',
   'Jul','Aug','Sep','Okt','Nov','Dec'],
   dayNames: ['Söndag','Måndag','Tisdag','Onsdag','Torsdag','Fredag','Lördag'],
   dayNamesShort: ['Sön','Mån','Tis','Ons','Tor','Fre','Lör'],
   dayNamesMin: ['Sö','Må','Ti','On','To','Fr','Lö'],
   weekHeader: 'V',
   dateFormat: 'dd.mm.yy',
   firstDay: 1,
   isRTL: false,
   showMonthAfterYear: false,
   yearSuffix: ''};

$.timepicker.regional['se'] = {
   timeOnlyTitle: 'Välj tid',
   timeText: 'Tid',
   hourText: 'Timma',
   minuteText: 'Minut',
   secondText: 'Sekund',
   currentText: 'Aktuell Tid',
   closeText: 'Stäng',
   ampm: false
};

$.datepicker.setDefaults($.datepicker.regional['se']);
$.timepicker.setDefaults($.timepicker.regional['se']);