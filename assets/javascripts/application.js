$(document).ready(function() {
  questionnaire.initialize();
  notifications.initialize();
  alumni.initialize();
  admin.initialize();
});

var questionnaire = {
  initialize: function() {
    questionnaire.initializeSlides();
    questionnaire.initializeSelectBoxes();
    questionnaire.initializePersonalInformation();
    questionnaire.initializeEducationalBackground();
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
        $(this).siblings('.specify').removeClass('hidden').focus();
      } else {
        $(this).siblings('.specify').addClass('hidden').val('');
      }
    });
  },
  initializePersonalInformation: function() {
    $('a[data-behavior="same-address"]').on('click', function(e) {
      e.preventDefault();
      $('input[name="personal_information[permanent_address]"]').val($('input[name="personal_information[present_address]"]').val());
    });
    $('a[data-behavior="same-contact-number').on('click', function(e) {
      e.preventDefault();
      $('input[name="personal_information[permanent_address_contact_number]"]').val($('input[name="personal_information[present_address_contact_number]"]').val());
    });
  },
  initializeEducationalBackground: function() {
    $('input[data-behavior="took-another-degree"]').on('change', function() {
      if ($(this).val() == 'yes') {
        var index = $('.educational-history-list .educational-history').length;
        $('.educational-history-list').removeClass('hidden');
        $('.educational-history-list a').before($('#educational-history-template').html().replace(/#{index}/g, index));
      } else {
        $('.educational-history-list').addClass('hidden').find('.educational-history').remove();
      }
    });

    $('.educational-history-list a[data-behavior="add-another-degree"]').on('click', function(e) {
      e.preventDefault();
      var index = $('.educational-history-list .educational-history').length;
      $(this).before($('#educational-history-template').html().replace(/#{index}/g, index));
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

    $('input[type="range"]').on('change', function() {
      var value = parseInt($(this).val());
      var satisfaction;
      switch (value) {
        case 1: satisfaction = 'very unsatisfied'; break;
        case 2: satisfaction = 'unsatisfied'; break;
        case 3: satisfaction = 'a bit unsatisfied'; break;
        case 4: satisfaction = 'neutral'; break;
        case 5: satisfaction = 'a bit satisfied'; break;
        case 6: satisfaction = 'satisfied'; break;
        case 7: satisfaction = 'very satisfied'; break;
      }
      $(this).next('span').text(value + ' - ' + satisfaction);
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
    newJobForm.find('input[type="range"]').on('change', function() {
      var value = parseInt($(this).val());
      var satisfaction;
      switch (value) {
        case 1: satisfaction = 'very unsatisfied'; break;
        case 2: satisfaction = 'unsatisfied'; break;
        case 3: satisfaction = 'a bit unsatisfied'; break;
        case 4: satisfaction = 'neutral'; break;
        case 5: satisfaction = 'a bit satisfied'; break;
        case 6: satisfaction = 'satisfied'; break;
        case 7: satisfaction = 'very satisfied'; break;
      }
      $(this).next('span').text(value + ' - ' + satisfaction);
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
        var emailRegEx = /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/;
        if ($('input[name="personal_information[email_address]"]').val().trim().match(emailRegEx)) {
          return {valid: true};
        }
        return {valid: false, error: 'Your email address is not in a valid format.'}
      }
      return {valid: false, error: 'Please fill up all required fields.'};
    },
    'educational-background': function() {
      var studentNumber = $('input[name="educational_background[student_number]"]').val().trim();
      if (studentNumber.length > 0 && !studentNumber.match(/^\d{4}-\d{5}/)) {
        return {valid: false, error: 'Please fill up the student number with the correct format.'};
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
            <= parseInt($('select[name="employment_history[' + i + '][employment_duration][end_year]"]').val()))) {
          
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
    if ($('body').hasClass('alumni')) {
      alumni.initializeSidebar();
      alumni.initializeEditableFields();
      alumni.initializeEducationalBackground();
      alumni.initializeEmploymentHistory();
    }
  },
  initializeSidebar: function() {
    $('.alumni.home aside a').on('click', function(e) {
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
      if ($(this).siblings('.editable').first().is('input[type="text"]')) {
        $(this).siblings('.editable').first().focus();
      }
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
      if ($(this).closest('.slide').find('.editable').not('.hidden').length == 0
        && $(this).closest('.slide').find('.educational-history').filter(function() {
          return $(this).has('input[name^="educational_background[new_educational_history]"]');
        }).length == 0) {
        $(this).closest('.slide').find('.actions input[type="submit"]').addClass('hidden');
      }
    });
  },
  initializeEducationalBackground: function() {
    $('.alumni.home a[data-behavior="add-another-degree"]').on('click', function(e) {
      e.preventDefault();
      $(this).closest('.slide').find('.actions input[type="submit"]').removeClass('hidden');
    });

    $('.alumni.home .educational-history-list').on('click', ' .educational-history a', function(e) {
      e.preventDefault();
      if ($(this).closest('.slide').find('.editable').not('.hidden').length == 0
        && $(this).closest('.slide').find('.educational-history').filter(function() {
          return $(this).has('input[name^="educational_background[new_educational_history]"]');
        }).length == 1) {
        $(this).closest('.slide').find('.actions input[type="submit"]').addClass('hidden');
      }
    });
  },
  initializeEmploymentHistory: function() {
    $('.button[data-behavior="update-current-job"]').on('click', function() {
      $('.job-form[data-job-form="current-job"]').removeClass('hidden');
      $(this).addClass('hidden').siblings('.button, a').removeClass('hidden');
    });
    $('.field.actions a').on('click', function(e) {
      e.preventDefault();
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

var admin = {
  initialize: function() {
    admin.initializeQuestionnaireData();
    admin.initializeFormCleaning();
    admin.initializeEnumerators();
  },
  initializeQuestionnaireData: function() {
    if ($('body').hasClass('admin index') || $('body').hasClass('enumerator index')) {
      $('section input[type="checkbox"]').on('change', function() {
        var section = $(this).closest('section');
        if (section.find('input[type="checkbox"]:checked').length > 0) {
          section.find('.replacement-form').removeClass('hidden');
        } else {
          section.find('.replacement-form').addClass('hidden');
        }
      });

      $('section:not(#ge-courses) h3').delegate('a[data-behavior="edit"]', 'click', function(e) {
        e.preventDefault();
        var form = $(this).siblings('form');
        form.toggleClass('hidden');
        form.find('input[type="text"]').focus();
        $(this).siblings('span').toggleClass('hidden');
        $(this).attr('data-behavior', 'cancel').text('[cancel]');
      }).delegate('a[data-behavior="cancel"]', 'click', function(e) {
        e.preventDefault();
        var form = $(this).siblings('form');
        form.toggleClass('hidden');
        form.find('input[type="text"]').val(form.find('input[type="text"]').data('current'));
        $(this).siblings('span').toggleClass('hidden');
        $(this).attr('data-behavior', 'edit').text('[edit]');
      });

      $('section h3 div').delegate('a[data-behavior="edit"]', 'click', function(e) {
        e.preventDefault();
        var form = $(this).closest('div').siblings('form');
        form.toggleClass('hidden');
        form.find('input[type="text"]').first().focus();
        form.siblings('p').toggleClass('hidden');
        $(this).attr('data-behavior', 'cancel').text('[cancel]');
        form.append(form.siblings('div'));
        form.siblings('div').remove();
      }).delegate('a[data-behavior="cancel"]', 'click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        form.toggleClass('hidden');
        form.find('input[type="text"]').each(function() {
          $(this).val($(this).data('current'));
        });
        form.siblings('p').toggleClass('hidden');
        $(this).attr('data-behavior', 'edit').text('[edit]');
        form.after(form.find('div'));
        form.find('div').remove();
      });
    }
  },
  initializeFormCleaning: function() {
    if ($('body').hasClass('admin clean') || $('body').hasClass('enumerator clean')) {
      $('.field').delegate('a[data-behavior="edit"]', 'click', function(e) {
        e.preventDefault();
        $(this).siblings('.editable, h4').toggleClass('hidden');
        $(this).siblings('.editable').find('input[type="text"], textarea').first().focus();
        $(this).attr('data-behavior', 'cancel').text('[cancel]');
      }).delegate('a[data-behavior="cancel"]', 'click', function(e) {
        e.preventDefault();
        $(this).siblings('.editable, h4').toggleClass('hidden');
        $(this).siblings('.editable').find('input[type="text"], textarea').each(function() {
          $(this).val($(this).data('current'));
        });
        $(this).siblings('.editable').find('input[type="radio"]').each(function() {
          $(this).prop('checked', $(this).data('current'));
        });
        $(this).siblings('.editable').find('select').each(function() {
          $(this).val($(this).data('current'));
        });
        $(this).attr('data-behavior', 'edit').text('[edit]');
      });
    }

    $('input[type="button"][data-behavior="add-another-degree"]').on('click', function() {
      admin.addAnotherDegree();
    });

    $('.educational-history-list').on('click', '.educational-history:has(.field > input) > a', function(e) {
      e.preventDefault();
      $(this).closest('.educational-history').remove();
    });

    $('input[type="button"][data-behavior="add-another-job"]').on('click', function() {
      admin.addAnotherJob();
    });
  },
  addAnotherDegree: function() {
    var index = $('.educational-history-list .educational-history').length;
    $('input[type="button"][data-behavior="add-another-degree"]').after($('#educational-history-template').html().replace(/#{index}/g, index));
  },
  addAnotherJob: function() {
    var index = $('.job-form').length;
    var job = $('<div class="job-form"></div>');
    job.html($('#job-form-template').html().replace(/{{index}}/g, index));
    $('input[type="button"][data-behavior="add-another-job"]').after(job);
    job.find('input[type="radio"][data-behavior="toggle-self-employed"]').on('change', function() {
      job.find('.field[data-field="business"], .field[data-field="employer"]').toggleClass('hidden');
    });
    job.find('a[data-behavior="discard-another-job"]').on('click', function(e) {
      e.preventDefault();
      $(this).closest('.job-form').remove();
    });
    job.find('input[type="range"]').on('change', function() {
      var value = parseInt($(this).val());
      var satisfaction;
      switch (value) {
        case 1: satisfaction = 'very unsatisfied'; break;
        case 2: satisfaction = 'unsatisfied'; break;
        case 3: satisfaction = 'a bit unsatisfied'; break;
        case 4: satisfaction = 'neutral'; break;
        case 5: satisfaction = 'a bit satisfied'; break;
        case 6: satisfaction = 'satisfied'; break;
        case 7: satisfaction = 'very satisfied'; break;
      }
      $(this).next('span').text(value + ' - ' + satisfaction);
    });
  },
  initializeEnumerators: function() {
    if ($('body').hasClass('admin enumerators')) {
      $('.enumerator').delegate('input[type="button"][data-behavior="edit"]', 'click', function() {
        $(this).attr('value', 'Cancel Edit').attr('data-behavior', 'cancel');
        $(this).siblings('input[type="submit"]').toggleClass('hidden');
        $(this).closest('.actions').siblings('.privileges, .editable').toggleClass('hidden');
      }).delegate('input[type="button"][data-behavior="cancel"]', 'click', function() {
        $(this).attr('value', 'Edit Account').attr('data-behavior', 'edit');
        $(this).siblings('input[type="submit"]').toggleClass('hidden');
        $(this).closest('.actions').siblings('.privileges, .editable').toggleClass('hidden');
        $(this).closest('.actions').siblings('.editable').find('input[type="checkbox"]').each(function() {
          $(this).prop('checked', $(this).data('current'));
        });
      });
    }
  }
};