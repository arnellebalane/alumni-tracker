$(document).ready(function() {
  questionnaire.initialize();
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
      // if (true) {
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
        $(this).next('input[type="text"]').removeClass('hidden').focus();
      } else {
        $(this).next('input[type="text"]').addClass('hidden').val('');
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
    var newJobForm = $('.job-form[data-job-form="first-job"]').clone();
    newJobForm.data('job-form', 'other-job');
    newJobForm.find('span').text('Other Job Information');
    newJobForm.find('select.specifiable + input[type="text"]').hide();
    newJobForm.find('input[type="text"], textarea').val('');
    newJobForm.find('select option').first().prop('selected');
    newJobForm.find('input[type="radio"]').prop('checked', false);
    newJobForm.find('input[type="radio"][data-behavior="toggle-self-employed"]').last().prop('checked', true);
    newJobForm.find('input[type="radio"][data-behavior="toggle-self-employed"]').each(function() {
      var id = $(this).attr('id');
      var newId = id.substring(0, 19) + $('.job-form').length + id.substring(20);
      $(this).attr('id', newId);
      $(this).next('label').attr('for', newId);
    });
    newJobForm.find('input[type="text"], input[type="radio"], select, textarea').each(function() {
      var name = $(this).attr('name');
      var newName = name.substring(0, 19) + $('.job-form').length + name.substring(20);
      $(this).attr('name', newName);
    });
    $('#aj-yes').prop('checked', false);
    $('#aj-no').prop('checked', true);
    $('.slide.current .field[data-field="another-job"]').before(newJobForm);
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