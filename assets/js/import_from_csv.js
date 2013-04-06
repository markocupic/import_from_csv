document.addEvent('domready', function ()
{
       if (document.id('saveNclose'))
              document.id('saveNclose').setStyle('visibility','hidden');
       if (document.id('saveNcreate'))
              document.id('saveNcreate').setStyle('visibility','hidden');
       if (document.id('save'))
              document.id('save').setProperty('value', 'Daten in Tabelle importieren');
       
       if ($$('.header_new'))
       {
              $$('.header_new').setProperty('title', 'start a new csv-import');
       }
});