/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2016 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
(function(document, window, $) {
  'use strict';

  var Site = window.Site;

  $(document).ready(function($) {
    Site.run();
  });

  // Example Click to edit
  // ---------------------
  window.edit = function() {
    $('.click2edit').summernote({
      focus: true
    });
  };
  window.save = function() {
    $('.click2edit').summernote('destroy');
  };

  // Example Hint for words
  // ----------------------
  (function() {
    $("#exampleHint2Basic").summernote({
      height: 100,
      toolbar: false,
      placeholder: 'type with apple, orange, watermelon and lemon',
      hint: {
        words: ['apple', 'arange', 'watermelon', 'lemon'],
        match: /\b(\w{1,})$/,
        search: function(keyword, callback) {
          callback($.grep(this.words, function(item) {
            return item.indexOf(keyword) === 0;
          }));
        }
      }
    });
  })();

  // Example Hint for words
  // ----------------------
  (function() {
    $("#exampleHint2Mention").summernote({
      height: 100,
      toolbar: false,
      hint: {
        mentions: ['jayden', 'sam', 'alvin', 'david'],
        match: /\B@(\w*)$/,
        search: function(keyword, callback) {
          callback($.grep(this.mentions, function(item) {
            return item.indexOf(keyword) == 0;
          }));
        },
        content: function(item) {
          return '@' + item;
        }
      }
    });
  })();

})(document, window, jQuery);

function editComm(id) {
  var token = $('#_lmtoken').val();
    $('#'+id).summernote({
      focus: true,
      callbacks: {
        onChange: function(contents, $editable) {
          var goalid = $(this).attr('id');
          if(goalid.match("^cma1") || goalid.match("^cmak1") || goalid.match("^cmal1"))
          {
            goalid = $(this).attr('goalid');
          }
          var empid  = $(this).attr('empid');
          var formData = {'_token':token, 'comments':contents, 'goalid':goalid, 'empid':empid, 'type': 1};

          $.post('/lm', formData, function(data,xhr,status){
            $("#status"+goalid).removeClass('hide');
            $("#status"+goalid).text('Status: Saved.');
          });
        }, 
        onBlur: function() {
          $(this).summernote('destroy');    
          $("#status"+$(this).attr('id')).fadeOut("slow");
        }
      }
    });
}

function saveComm(id) {
  $('#'+id).summernote('destroy');
}