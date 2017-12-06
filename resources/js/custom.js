
function parseResult(word, res) {
  var html = '<h2>Definitions of "' + word + '":</h2><br/>';

  // Each Result
  $.each(res.results, function(i, result) {

    // Each result may have multiple lexical entries (ex: Verb, Noun, etc..)
    var lexicalEntries = result.lexicalEntries;

    $.each(lexicalEntries, function(j, lexicalEntry) {

      html += '<p><b>' + lexicalEntry.lexicalCategory + '</b></p>';

      var entries = lexicalEntry.entries;

      html += '<hr>';

      // Each entry definition
      $.each(entries, function(k, entry) {

        html += '<ol>';

        var senses = entry.senses;

        //Each entry sense
        $.each(senses, function(l, sense) {

          html += '<li>';

          if(sense.hasOwnProperty('domains')) {
            //Each domain show a badge
            $.each(sense.domains, function(k, domain) {
              html += '<span class="badge badge-info">' + domain + '</span>';
            });

          }

          if(sense.hasOwnProperty('definitions')) {
            var definitions = sense.definitions;

            $.each(definitions, function(m, definition) {
              html += '<p>' + definition + '</p>';
            });
          }

          if(sense.hasOwnProperty('examples')) {
            var examples = sense.examples;

            html += '<p>Examples:</p>';

            html += '<ol>';

            $.each(examples, function(n, example) {
              html += '<li><p>"' + example.text + '"</p></li>';
            });

            html += '</ol>';
          }

          html += '</li>';

        });

        html += '</ol>';

        html += '<hr>';

      });

      html += '<br/><br/>';
    });
  });

  return html;

}

$(document).ready(function(){

    //Suggest autocomplete words
    $('input#word.typeahead').typeahead({
      minLength: 3,
	    source:  function (query, process) {
        var lang = $('#lang').val();
        var res = [];
        return $.post( "suggest.php", {lang: lang, word: query}, function (data) {
        		data = $.parseJSON(data);

            if(data.hasOwnProperty('results')) {
              $.each(data.results, function(i, result) {
                console.log(result.word);
                res.push(result.word);
              });
            }

	          return process(res);
	        });
	    }
	});

    //Search word
    $("#word-search").submit(function(e){

      e.preventDefault();

      var lang = $('#lang').val();
      var word = $('#word').val();

      $('div.result').html('');

      if(!word) {
        $('div.result').html('<p class="alert alert-danger" role="alert">Please type a word in the form above.</p>');
      } else {

        // Show loader icon
        $('.loader').removeClass('hidden');

        // AJAX POST request to search for the word in the Oxford API
        $.post( "search.php", {lang: lang, word: word}, function( data ) {
          var res = $.parseJSON(data);

          if(res.hasOwnProperty('error')) { // If error or word not found
            $('div.result').html('<p class="alert alert-danger" role="alert">'+res.error+'</p>');
          } else { // Word found in selected language
            $('div.result').html(parseResult(word, res));
          }

        }).done( function() {
          // Hide loader icon
          $('.loader').addClass('hidden');
        });

      }

    });
});
