$(document).ready(function() {
  questionnaire.initialize();
  notifications.initialize();
  alumni.initialize();
});

var questionnaire = {
  initialize: function() {
    questionnaire.initializeSlides();
    questionnaire.initializeSelectBoxes();
    questionnaire.initializeEmploymentHistory();
    questionnaire.initializeOthers();
  },
  initializeSlides: function() {
    $('.slide .button.continue').on('click', function() {
      var validation = questionnaire.validateSlide[$(".slide.current").data('name')]();
      if (validation.valid) {
      //if (true) {
        $('.slide.current').toggleClass('current hidden').next('.slide').toggleClass('current hidden');
        $('aside li.current').removeClass('current').next('li').addClass('current visited');
      } else {
        alert(validation.error);
      }
    });
    $('.slide .button.back').on('click', function() {
      $('.slide.current').toggleClass('current hidden').prev('.slide').toggleClass('current hidden');
      $('aside li.current').removeClass('current').prev('li').addClass('current');
    });
  },
  initializeSelectBoxes: function() {
    $('select.specifiable').on('change', function() {
      if ($(this).val() == 'others') {
        $(this).siblings('.specify').removeClass('hidden').focus();
      } else {
        $(this).siblings('.specify').addClass('hidden').val('');
      }
    });
  },
  initializeEmploymentHistory: function() {
    $('input[type="radio"][data-behavior="toggle-self-employed"]').on('change', function() {
      $(this).closest('.job-form').find('.field[data-field="business-name"], .field[data-field="employer"]').toggleClass('hidden');
    });

    $('input[type="radio"][data-behavior="toggle-first-job"]').on('change', function() {
      if ($(this).val() == 'yes') {
        $('.job-form[data-job-form="first-job"], .field[data-field="another-job"]').addClass('hidden');
        $('.job-form[data-job-form="other-job"]').remove();
      } else {
        $('.job-form[data-job-form="first-job"], .field[data-field="another-job"]').removeClass('hidden');
      }
    });

    $('input[type="radio"][data-behavior="add-another-job"]').on('change', function() {
      if ($(this).val() == 'yes') {
        questionnaire.addAnotherJob();
      }
    });
  },
  initializeOthers: function() {
    $('input[type="radio"][name="others[jobs_related]"]').on('change', function() {
      $('.slide[data-name="others"] .field').not($(this).closest('.field')).not('.actions').toggleClass('hidden');
    });
  },
  addAnotherJob: function() {
    var index = $('.slide[data-name="employment-history"] > .job-form').length;
    var newJobForm = $('<div class="job-form" data-job-form="other-job"></div>');
    newJobForm.html($('#job-form-template .job-form').html().replace(/#{index}/g, index));
    $('#aj-yes').prop('checked', false);
    $('#aj-no').prop('checked', true);
    newJobForm.find('input[type="radio"][data-behavior="toggle-self-employed"]').on('change', function() {
      $(this).closest('.job-form').find('.field[data-field="business-name"], .field[data-field="employer"]').toggleClass('hidden');
    });
    newJobForm.find('.specifiable').on('change', function() {
      if ($(this).val() == 'others') {
        $(this).siblings('.specify').removeClass('hidden').focus();
      } else {
        $(this).siblings('.specify').addClass('hidden').val('');
      }
    });
    $('.field[data-field="another-job"]').before(newJobForm);
  },
  validateSlide: {
    'personal-information': function() {
      if (($('input[name="personal_information[firstname]"]').val().trim().length > 0)
        && ($('input[name="personal_information[lastname]"]').val().trim().length > 0)
        && ($('input[name="personal_information[gender]"]:checked').length > 0)
        && ($('input[name="personal_information[present_address]"]').val().trim().length > 0)
        && ($('select[name="personal_information[country]"]').val() != 'others' 
          || $('input[name="personal_information[specified_country]"]').val().trim().length > 0)
        && ($('input[name="personal_information[present_address_contact_number]"]').val().trim().length > 0)
        && ($('input[name="personal_information[permanent_address]"]').val().trim().length > 0)
        && ($('input[name="personal_information[permanent_address_contact_number]"]').val().trim().length > 0)
        && ($('input[name="personal_information[email_address]"]').val().trim().length > 0)) {
        return {valid: true};
      } else {
        return {valid: false, error: "Please fill up all required fields."};
      }
    },
    'educational-background': function() {
      var studentNumber = $('input[name="educational_background[student_number]"]').val().trim();
      if (studentNumber.length != 10 || studentNumber.charAt(4) != '-') {
        return {valid: false, error: 'Please fill up the student number with the correct format.'};
      }
      var digits = '0123456789';
      for (var i = 0; i < 10; i++) {
        if (i == 4) {
          continue;
        }
        if (digits.indexOf(studentNumber.charAt(i)) < 0) {
          return {valid: false, error: 'Please fill up the student number with the correct format.'};
        }
      }
      return {valid: true};
    },
    'employment-history': function() {
      for (var i = 0; i < $('.job-form').length; i++) {
        if (($('input[name="employment_history[' + i + '][business_name]"]').val().trim().length > 0
            || $('input[name="employment_history[' + i + '][employer]"]').val().trim().length > 0)
          && ($('select[name="employment_history[' + i + '][employer_type]"]').val() != 'others'
            || $('input[name="employment_history[' + i + '][specified_employer_type]"]').val().trim().length > 0)
          && ($('input[name="employment_history[' + i + '][job_title]"]').val().trim().length > 0)
          && (parseInt($('select[name="employment_history[' + i + '][employment_duration][start_year]"]').val()) 
            <= parseInt($('select[name="employment_history[' + i + '][employment_duration][end_year]"]').val()))
          && ($('input[name="employment_history[' + i + '][satisfied_with_job]"]:checked').length > 0)) {
          
        } else {
          return {valid: false, error: "Please fill up all required fields."};
        }
        if ($('input[data-behavior="toggle-first-job"]').val() == 'yes') {
          break;
        }
      }
      return {valid: true};
    },
    'others': function() {

    }
  }
};

var notifications = {
  initialize: function() {
    if ($('p.notification').length > 0) {
      $('p.notification').addClass('shown');
      setTimeout(function() {
        $('p.notification').removeClass('shown');
      }, 2500);
    }
  }
};

var alumni = {
  initialize: function() {
    alumni.initializeSidebar();
    alumni.initializeEditableFields();
    alumni.initializeEmploymentHistory();
  },
  initializeSidebar: function() {
    $('aside a').on('click', function(e) {
      e.preventDefault();
      var li = $(this).closest('li');
      if (!li.hasClass('current')) {
        $('.slide.current').toggleClass('current hidden');
        $('.slide[data-name="' + li.data('slide') + '"]').toggleClass('current hidden');
        $('aside li.current').removeClass('current');
        li.addClass('current');
      }
    });
  },
  initializeEditableFields: function() {
    $('.field').delegate('a[data-behavior="edit"]', 'click', function(e) {
      e.preventDefault();
      $(this).text('[cancel]').attr('data-behavior', 'cancel').siblings('h2').addClass('hidden').siblings('.editable').removeClass('hidden');
      $(this).closest('.slide').find('.actions input[type="submit"]').removeClass('hidden');
    });
    $('.field').not('.actions').delegate('a[data-behavior="cancel"]', 'click', function(e) {
      e.preventDefault();
      $(this).text('[edit]').attr('data-behavior', 'edit').siblings('h2').removeClass('hidden').siblings('.editable, .specify').addClass('hidden');
      $(this).siblings('input[type="text"].editable, input[type="email"].editable, select.editable, textarea.editable').each(function() {
        $(this).val($(this).data('current'));
      });
      $(this).siblings('input[type="radio"].editable').each(function() {
        $(this).prop('checked', $(this).data('current') == 'checked');
      });
      if ($(this).closest('.slide').find('.editable').not('.hidden').length == 0) {
        $(this).closest('.slide').find('.actions input[type="submit"]').addClass('hidden');
      }
    });
  },
  initializeEmploymentHistory: function() {
    $('.button[data-behavior="update-current-job"]').on('click', function() {
      $('.job-form[data-job-form="current-job"]').removeClass('hidden');
      $(this).addClass('hidden').siblings('.button, a').removeClass('hidden');
    });
    $('.field.actions a').on('click', function() {
      var slide = $(this).closest('.slide');
      $(this).addClass('hidden').siblings('.button').toggleClass('hidden');
      $('.job-form[data-job-form="current-job"]').addClass('hidden');
      slide.find('input[type="text"], textarea').val('');
      slide.find('input[type="radio"][data-behavior="toggle-self-employed"][value="1"]').prop('checked', false);
      slide.find('input[type="radio"][data-behavior="toggle-self-employed"][value="0"]').prop('checked', true);
      slide.find('.field[data-field="business-name"]').addClass('hidden');
      slide.find('.field[data-field="employer"]').removeClass('hidden');
      slide.find('select option:first-of-type').prop('selected', true);
    });
  }
};