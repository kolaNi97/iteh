        (function($,W,D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#form").validate({
                        rules: {
                            NazivFilma: {
                                required: true,
                                minlength: 2,
                                maxlength: 100
                            },
                            Trajanje: {
                                required: true
                            },
                            Cena: {
                                required: true,
                                minlength: 1,
                                maxlength: 10,
                                number: true
                            }
                            
                        },
                        messages: {
                            NazivFilma: {
                                required: "Polje je obavezno!",
                                minlength: "Polje mora imati minimum 2 karaktera!",
                                maxlength: "Polje može imati maksimum 100 karaktera!"
                            },
                            Trajanje: {
                                required: "Polje je obavezno!"
                            },
                            Cena: {
                                required: "Polje je obavezno!" ,
                                minlength: "Polje mora imati minimum 1 karaktera!",
                                maxlength: "Polje može imati maksimum 10 karaktera!",
                                number: "Morate uneti brojeve!"
                            }
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                }
            }
            $(D).ready(function($) {
                JQUERY4U.UTIL.setupFormValidation();
            });
        })(jQuery, window, document);
