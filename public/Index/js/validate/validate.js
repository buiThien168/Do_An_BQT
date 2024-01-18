
$("#form-add-department").validate({
    rules: {
        room_name: {
            required : true,
            maxlength: 255,
        },
        note:{
            required : false,
            maxlength: 255,
        }
    },
    messages: {
        room_name: {
            required: "Please Name department",
            maxlength: "Name department has a maximum of 255 characters",
        },
        note: {
            maxlength: "Details can be up to 255 characters",
        },  
    },
    submitHandler: function(form) { 
     form.submit();
 }
});

$("#form-edit-steff").validate({
    rules: {
        full_name: {
            required : true,
            maxlength: 255,
        },
        nick_name:{
            required : true,
            maxlength: 255,
        },
        phone:{
            required : true,
            maxlength: 10,
            minlength:10,
            digits:true,
        },
        email:{
            required : true,
            email:true,
        },
        date_of_birth:{
            required : true,
        },
        place_of_birth:{
            required : true,
            maxlength: 255,
        },
        id_number:{
            required : true,
            digits:true,
            maxlength: 20,
        },
        date_range:{
            required : true,
        },
        passport_issuer:{
            required : true,
            maxlength: 255,
        },
        hometown:{
            required : true,
            maxlength: 255,
        },
        nationality:{
            required : true,
            maxlength: 255,
        },
        nation:{
            required : true,
            maxlength: 255,
        },
        religion:{
            required : true,
            maxlength: 255,
        },
        permanent_residence:{
            required : true,
            maxlength: 255,
        },
        staying:{
            required : true,
            maxlength: 255,
        }
    },
    messages: {
        full_name: {
            required: "Please enter Full name",
            maxlength: "Maximum length 255 characters",
        },
        nick_name: {
            required: "Please enter Nickname",
            maxlength: "Maximum length 255 characters",
        }, 
        phone: {
            required: "Please enter  Phone",
            maxlength: "Phone has 10 numbers",
            minlength: "Phone has 10 numbers",
            digits:"Please enter integer"
        }, 
        email: {
            required: "Please enter email",
            email:"Please enter correct email format"
        }, 

        date_of_birth: {
            required: "Please enter Date of birth",
        }, 
        place_of_birth: {
            required: "Please enter Place of birth",
            maxlength: "Enter up to 255 characters",
        }, 
        id_number: {
            required: "Please enter  ID number",
            maxlength: "Cmnd enter up to 20 characters",
            digits:"Please enter integer"
        },    
        date_range: {
            required: "Please enter Password",
        }, 
        passport_issuer: {
            required: "Please enter Passport issuer",
            maxlength: "Enter up to 255 characters",
        }, 
        hometown: {
            required: "Please enter Domicile",
            maxlength: "Enter up to 255 characters",
        }, 
        nationality:{
            required: "Please enter Nationality",
            maxlength: "Enter up to 255 characters",
        },
        nation:{
            required: "Please enter Nation",
            maxlength: "Enter up to 255 characters",
        },
        religion:{
            required: "Please enter Religion",
            maxlength: "Enter up to 255 characters",
        },
        permanent_residence:{
            required: "Please enter Household",
            maxlength: "Enter up to 255 characters",
        },
        staying:{
            required: "Please enter Staying",
            maxlength: "Enter up to 255 characters",
        }
    },
    submitHandler: function(form) { 
     form.submit();
 }
});

$("#form-add-steff").validate({
    rules: {
        full_name: {
            required : true,
            maxlength: 255,
        },
        nick_name:{
            required : true,
            maxlength: 255,
        },
        image:{
            required : true,
        },
        phone:{
            required : true,
            maxlength: 10,
            minlength:10,
            digits:true,

        },
        email:{
            required : true,
            email:true,
        },
        password:{
            required : true,
            minlength: 6,
            maxlength: 50,
        },
        date_of_birth:{
            required : true,
        },
        place_of_birth:{
            required : true,
            maxlength: 255,
        },
        id_number:{
            required : true,
            digits:true,
            maxlength: 20,
        },
        date_range:{
            required : true,
        },
        passport_issuer:{
            required : true,
            maxlength: 255,
        },
        hometown:{
            required : true,
            maxlength: 255,
        },
        nationality:{
            required : true,
            maxlength: 255,
        },
        nation:{
            required : true,
            maxlength: 255,
        },
        religion:{
            required : true,
            maxlength: 255,
        },
        permanent_residence:{
            required : true,
            maxlength: 255,
        },
        staying:{
            required : true,
            maxlength: 255,
        }
    },
    messages: {
        full_name: {
            required: "Please enter Full name",
            maxlength: "Maximum length 255 characters",
        },
        nick_name: {
            required: "Please enter Nickname",
            maxlength: "Maximum length 255 characters",
        }, 
        image: {
            required: "Please choose Image",
        }, 
        phone: {
            required: "Please enter Phone",
            maxlength: "Phone has 10 numbers",
            minlength: "Phone has 10 numbers",
            digits:"Please enter integer"
        }, 
        email: {
            required: "Please enter  email",
            email:"Please enter correct email format"
        }, 
        password: {
            required: "Please enter  Password",
            maxlength: "Password from 6 to 50 characters",
            minlength: "Password from 6 to 50 characters",
        },
        date_of_birth: {
            required: "Please enter Date of birth",
        }, 
        place_of_birth: {
            required: "Please enter Place of birth",
            maxlength: "Enter up to 255 characters",
        }, 
        id_number: {
            required: "Please enter ID number",
            maxlength: "Cmnd enter up to 20 characters",
            digits:"Please enter integer"
        },    
        date_range: {
            required: "Please enter Password",
        }, 
        passport_issuer: {
            required: "Please enter Passport issuer",
            maxlength: "Enter up to 255 characters",
        }, 
        hometown: {
            required: "Please enter Domicile",
            maxlength: "Enter up to 255 characters",
        }, 
        nationality:{
            required: "Please enter Nationality",
            maxlength: "Enter up to 255 characters",
        },
        nation:{
            required: "Please enter Nation",
            maxlength: "Enter up to 255 characters",
        },
        religion:{
            required: "Please enter Religion",
            maxlength: "Enter up to 255 characters",
        },
        permanent_residence:{
            required: "Please enter Household",
            maxlength: "Enter up to 255 characters",
        },
        staying:{
            required: "Please enter Staying",
            maxlength: "Enter up to 255 characters",
        }
    },
    submitHandler: function(form) { 
     form.submit();
 }
});



$("#login-user-form").validate({
    rules: {
        phone: {
            required : true,
            maxlength: 10,
            minlength:10,
            digits:true
        },
        password:{
            required : true,
            maxlength: 50,
        }
    },
    messages: {
        phone: {
            required: "Please enter  Phone",
            maxlength: "Phone is 10 numbers",
            maxlength: "Phone is 10 numbers",
            digits: "Please enter number",
        },
        password: {
            required: "Please enter Password",
            maxlength: "Password from 1 to 50 characters",
        },  
    },
    submitHandler: function(form) { 
     form.submit();
 }
});
$("#signup-user-form").validate({
    rules: {
        phone: {
            required : true,
            maxlength: 10,
            minlength:10,
            digits:true
        },
        password:{
            required : true,
            maxlength: 50,
        },
        re_password:{
            required : true,
            maxlength: 50,
        }
    },
    messages: {
        phone: {
            required: "Please enter Phone",
            minlength: "Phone is 10 numbers",
            maxlength: "Phone is 10 numbers",
            digits: "Please enter number",
        },
        password: {
            required: "Please enter Password",
            maxlength: "Password from 1 to 50 characters",
        }, 
        re_password: {
            required: "Please re-enter Password",
            maxlength: "Password from 1 to 50 characters",
        }, 
    },
    submitHandler: function(form) { 
     form.submit();
 }
});

$("#signup-shiper-form").validate({
    rules: {
        name: {
            required : true,
        },
        email: {
            required : true,
            email:true
        },
        phone: {
            required : true,
            maxlength: 10,
            minlength:10,
            digits:true
        },
        area: {
            required : true,
            digits:true
        },
        password:{
            required : true,
            maxlength: 50,
        },
        re_password:{
            required : true,
            maxlength: 50,
        }
    },
    messages: {
        name: {
            required: "Please enter  Full name",
        },
        email: {
            required: "Please enter  email",
            email: "Please enter  email",
        },
        phone: {
            required: "Please enter  Phone",
            maxlength: "Phone is 10 numbers",
            maxlength: "Phone is 10 numbers",
            digits: "Please enter number",
        },
        password: {
            required: "Please enter  Password",
            maxlength: "Password from 1 to 50 characters",
        }, 
        re_password: {
            required: "Please re-enter Password",
            maxlength: "Password from 1 to 50 characters",
        }, 
        area:{
            required: "Please choose  khu vực",
        }
    },
    submitHandler: function(form) { 
     form.submit();
 }
});
$("#login-admin-form").validate({
    rules: {
        name: {
            required : true,
        },
        password:{
            required : true,
            maxlength: 50,
        }
    },
    messages: {
        name: {
            required: "Please enter username",
        },
        password: {
            required: "Please enter Password",
            maxlength: "Password from 1 to 50 characters",
        },  
    },
    submitHandler: function(form) { 
     form.submit();
 }
});
// $(document).ready(function() {
//     toastr.options = {
//       'closeButton': true,
//       'debug': false,
//       'newestOnTop': false,
//       'progressBar': false,
//       'positionClass': 'toast-top-right',
//       'preventDuplicates': false,
//       'showDuration': '1000',
//       'hideDuration': '1000',
//       'timeOut': '5000',
//       'extendedTimeOut': '1000',
//       'showEasing': 'swing',
//       'hideEasing': 'linear',
//       'showMethod': 'fadeIn',
//       'hideMethod': 'fadeOut',
//   }
// });

// $("#add-mail-box").validate({
//     rules: {
//         title: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         },
//         content: {
//             required : true,
//             maxlength: 25000,
//             minlength:1
//         },
//     },
//     messages: {
//         title: {
//             required: "Please enter  Title",
//             maxlength: "Title thư từ 1 đến 255 ký tự",
//             minlength: "Title thư từ 1 đến 255 ký tự"
//         },
//         content: {
//             required: "Please enter  Content",
//             maxlength: "Title thư từ 1 đến 25000 ký tự",
//             minlength: "Title thư từ 1 đến 25000 ký tự"
//         },
//     },
//     submitHandler: function(form) { 
//        var content = tinyMCE.activeEditor.getContent();
//        if (content === "" || content === null) {
//         $("#editerInput").html('<label class="error" for="news_description">Please enter  Content</label>');
//         notitication();
//     } else {
//         $("#editerInput").html("");
//         if($('#multiselect').val() != ""){
//             form.submit();
//         }else{
//             $("#chooseInput").html('<label class="error" for="news_description">Please choose  thành viên</label>');
//             notitication();
//         }

//     }    
// },
// errorPlacement: function(error, element) {
//     error.insertAfter(element);
//     notitication();
// }

// });

// $("#form-add-campaign").validate({
//     rules: {
//         campaign_name: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         },
//         start_time_hour:{
//             required :false,
//             max: 25,
//             min:0,
//             digits:true
//         },
//         start_time_min:{
//             required :false,
//             max: 60,
//             min:0,
//             digits:true
//         }
//     },
//     messages: {
//         campaign_name: {
//             required: "Please enter  tên chiến dịch",
//             maxlength: "Tên chiến dịch từ 1 đến 255 ký tự",
//             minlength: "Tên chiến dịch từ 1 đến 255 ký tự",
//             digits:"Please enter  đúng định dạng"
//         },
//         start_time_hour: {
//             max: "Số hour trong khoảng từ 0 đến 24",
//             min: "Số hour trong khoảng từ 0 đến 24",
//             digits:"Please enter  đúng định dạng"
//         },
//         start_time_min: {
//             max: "Số phút trong khoảng từ 0 đến 60",
//             min: "Số phút trong khoảng từ 0 đến 60",
//             digits:"Please enter  đúng định dạng"
//         }
//     },
//     submitHandler: function(form) { 

//         if($('#date-send').val() == "" && $('#start-time-hour-input').val() == "" && $('#start-time-min-input').val() == ""){
//             form.submit();
//         }else{
//             var checkError = 0;
//             if($('#date-send').val() != ""){
//                 if($('#start-time-hour-input').val() == ""){
//                     $("#error-hour").html('<label class="error">Please enter  hour</label>');
//                 }
//                 if($('#start-time-min-input').val() == ""){
//                    $("#error-min").html('<label class="error">Please enter  phút</label>');
//                }
//            }else{
//             checkError++;
//         }
//         if($('#start-time-hour-input').val() != ""){
//             if($('#date-send').val() == ""){
//                 $("#error-date").html('<label class="error">Please enter  ngày</label>');
//             }
//             if($('#start-time-min-input').val() == ""){
//                $("#error-min").html('<label class="error">Please enter  phút</label>');
//            }
//        }else{
//         checkError++;
//     }
//     if($('#start-time-min-input').val() != ""){
//         if($('#date-send').val() == ""){
//             $("#error-date").html('<label class="error">Please enter  ngày</label>');
//         }
//         if($('#start-time-hour-input').val() == ""){
//            $("#error-hour").html('<label class="error">Please enter  hour</label>');
//        }
//    }else{
//     checkError++;
// }
// if(checkError==0){
//  form.submit();
// }else{
//  notitication();
// }
// }
// },
// errorPlacement: function(error, element) {
//     error.insertAfter(element);
//     notitication();
// }

// });


// var checkAddMailConfig=false;
// $("#add-mail-config").validate({
//     rules: {
//         mail_host: {
//             required : true,
//             maxlength: 250,
//             minlength:1
//         },
//         mail_port: {
//             required : true,
//             max: 100000,
//             min:0
//         },
//         mail_username:{
//             required : true,
//             maxlength: 250,
//             minlength:1
//         },
//         mail_password:{
//             required : true,
//             maxlength: 250,
//             minlength:6
//         }
//     },
//     messages: {
//         mail_host: {
//             required: "Please enter  SMTP",
//             maxlength: "SMTP từ 1 đến 250 ký tự",
//             minlength: "Email subject từ 1 đến 250 ký tự"
//         },
//         mail_port: {
//             required: "Please enter  Gate",
//             max: "Gate có Value từ 0 đến 100000",
//             min: "Gate có Value từ 0 đến 100000"
//         },
//         mail_username: {
//             required: "Please enter  tên đăng nhập",
//             maxlength: "Tên đăng nhập từ 1 đến 250 ký tự",
//             minlength: "Tên đăng nhập từ 1 đến 250 ký tự"
//         },
//         mail_password: {
//             required: "Please enter  Password",
//             maxlength: "Password từ 6 đến 250 ký tự",
//             minlength: "Password từ 6 đến 250 ký tự"
//         }
//     },
//     submitHandler: function(form) { 
//         checkAddMailConfig=true;
//         if(typeButton == 'test'){
//             sendMailTest()  
//         }else{
//             submitMail() 
//         }

//     },
//     errorPlacement: function(error, element) {
//         error.insertAfter(element);
//         notitication();
//     }

// });


// $("#add-mail-template").validate({
//     rules: {
//         template_title: {
//             required : true,
//             maxlength: 250,
//             minlength:1
//         }
//         ,
//         template_content: {
//             required : true,
//             maxlength: 3000,
//             minlength:1
//         }
//     },
//     messages: {
//         template_title: {
//             required: "Please enter  Title",
//             maxlength: "Email subject từ 1 đến 250 ký tự",
//             minlength: "Email subject từ 1 đến 250 ký tự"
//         },
//         template_content: {
//             required: "Please enter  Content",
//             maxlength: "Email subject từ 1 đến 3000 ký tự",
//             minlength: "Email subject từ 1 đến 3000 ký tự"
//         }
//     },
//     submitHandler: function(form) { 
//        var content = tinyMCE.activeEditor.getContent();
//        if (content === "" || content === null) {
//         $("#editerInput").html('<label class="error" for="news_description">Please enter  Content</label>');
//         notitication();
//     } else {
//         $("#editerInput").html("");
//         form.submit();
//     }    
// },
// errorPlacement: function(error, element) {
//     error.insertAfter(element);
//     notitication();
// }

// });

// $("#edit-properties").validate({
//     rules: {
//         tenduan: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         giaban: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         huongnha: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         mohinh: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         giathue: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         quymo: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         chudautu: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         dientich: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         hotrovay: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         vitri: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         phaply: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         duong: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         tinhtrang: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         noithat: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//         dangngay: {
//             required : true,
//             maxlength: 100,
//             minlength:3
//         },
//     },

//     messages: {
//         tenduan: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         giaban: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         huongnha: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         mohinh: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         giathue: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         quymo: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         chudautu: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         dientich: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         hotrovay: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         vitri: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         phaply: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         duong: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         tinhtrang: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         noithat: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },
//         dangngay: {
//             required: "Please enter  Content",
//             maxlength: "Content gồm 3 đến 100 ký tự",
//             minlength: "Content gồm 3 đến 100 ký tự",
//         },

//     },

//     submitHandler: function(form) { 
//        form.submit();
//    },
//    errorPlacement: function(error, element) {
//     error.insertAfter(element);
//     notitication();
// }
// });
// $("#edit-setting-project").validate({
//     rules: {
//         ngattrang: {
//             required : true,
//             max: 255,
//             min:1,
//             digits:true
//         },
//         icon1: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         },
//         icon2: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         }
//         ,
//         icon3: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         }
//         ,
//         icon4: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         }
//         ,
//         icon5: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         },
//         icon6: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         }
//     },
//     messages: {
//         ngattrang: {
//             required: "Please enter number tin hiển thị",
//             max: "Số tin hiển thị từ 1 đến 255",
//             min: "Số tin hiển thị từ 1 đến 255",
//             digits:"Nhập một số nguyên",
//         },
//         icon1: {
//             required: "Please choose  Image",
//             max: "Đường dẫn từ 1 đến 255 ký tự",
//             min: "Đường dẫn từ 1 đến 255 ký tự"
//         },
//         icon2: {
//             required: "Please choose  Image",
//             max: "Đường dẫn từ 1 đến 255 ký tự",
//             min: "Đường dẫn từ 1 đến 255 ký tự"
//         },
//         icon3: {
//             required: "Please choose  Image",
//             max: "Đường dẫn từ 1 đến 255 ký tự",
//             min: "Đường dẫn từ 1 đến 255 ký tự"
//         },
//         icon4: {
//             required: "Please choose  Image",
//             max: "Đường dẫn từ 1 đến 255 ký tự",
//             min: "Đường dẫn từ 1 đến 255 ký tự"
//         },
//         icon5: {
//             required: "Please choose  Image",
//             max: "Đường dẫn từ 1 đến 255 ký tự",
//             min: "Đường dẫn từ 1 đến 255 ký tự"
//         },
//         icon6: {
//             required: "Please choose  Image",
//             max: "Đường dẫn từ 1 đến 255 ký tự",
//             min: "Đường dẫn từ 1 đến 255 ký tự"
//         }
//     },
//     submitHandler: function(form) { 
//         form.submit();
//     },
//     errorPlacement: function(error, element) {
//         error.insertAfter(element);
//         notitication()
//     }
// });



// $("#add-rank-form").validate({
//     rules: {
//         level_name: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         },
//         image_url: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         },
//         percent_special: {
//             required : true,
//             max: 100,
//             min:1,
//             digits:true
//         }
//         ,
//         classified_min_quantity: {
//             required : true,
//             max: 10000,
//             min:0,
//             digits:true
//         }
//         ,
//         classified_max_quantity: {
//             required : true,
//             max: 10000,
//             min:0,
//             digits:true
//         }
//         ,
//         deposit_min_amount: {
//             required : true,
//             max: 2000000000000,
//             min:0,
//             digits:true
//         },
//         deposit_max_amount : {
//             required : true,
//             max: 2000000000000,
//             min:0,
//             digits:true
//         }
//     },
//     messages: {
//         level_name: {
//             required: "Please enter  Title",
//             maxlength: "Title từ 1 đến 255 ký tự",
//             minlength: "Title từ 1 đến 255 ký tự"
//         },
//         image_url: {
//             required: "Please choose  Image",
//             maxlength: "Đường dẫn Image tối đa 255 ký tự",
//             minlength: "Đường dẫn Image tối đa 255 ký tự"
//         },
//         percent_special: {
//             required: "Please enter  phần trăm",
//             max: "Phần trăm từ 1 đến 100",
//             min: "Phần trăm từ 1 đến 100",
//             digits:"Nhập một số nguyên",
//         },
//         classified_min_quantity: {
//             required: "Please enter number tin tối thiểu",
//             max: "Số tin trong khoảng từ 0 đến 10000",
//             min: "Số tin trong khoảng từ 0 đến 10000",
//             digits:"Nhập một số nguyên",
//         },
//         classified_max_quantity: {
//             required: "Please enter number tin tối đa",
//             max: "Số tin trong khoảng từ 0 đến 10000",
//             min: "Số tin trong khoảng từ 0 đến 10000",
//             digits:"Nhập một số nguyên",
//         },
//         deposit_min_amount: {
//             required: "Please enter number tiền nạp tối thiểu",
//             max: "Số tin trong khoảng từ 0 đến 2000000000000",
//             min: "Số tin trong khoảng từ 0 đến 2000000000000",
//             digits:"Nhập một số nguyên",
//         },
//         deposit_max_amount: {
//             required: "Please enter number tiền nạp tối đa",
//             max: "Số tin trong khoảng từ 0 đến 2000000000000",
//             min: "Số tin trong khoảng từ 0 đến 2000000000000",
//             digits:"Nhập một số nguyên",
//         }
//     },
//     submitHandler: function(form) {
//        form.submit();
//    }
// });


// $("#add-border-form").validate({
//     rules: {
//         list_users: {
//             required : true,
//         },
//         image_url: {
//             required : true,
//             maxlength: 255,
//             minlength:1
//         },
//     },
//     messages: {
//         list_users: {
//             required: "Please choose  tối thiểu 1 tài khoản",
//         },
//         image_url: {
//             required: "Please choose  Image",
//             maxlength: "Đường dẫn Image tối đa 255 ký tự",
//             minlength: "Đường dẫn Image tối đa 255 ký tự"
//         },
//     },
//     submitHandler: function(form) {

//         if($('#multiselect').val() != ""){
//             form.submit();
//             $("#errorInput").html("");
//         }else{
//             $("#errorInput").html('<label class="error" for="news_description">Please choose  ít nhất 1 tài khoản</label>');
//         }


//     }
// });

// $("#setting-personal-page").validate({
//     rules: {
//         ngatbinhluandanhgia: {
//             required : true,
//             max: 255,
//             min:1,
//             digits:true
//         }
//         ,
//         songuoibaocao: {
//             required : true,
//             max: 255,
//             min:1,
//             digits:true
//         }

//     },
//     messages: {
//         ngatbinhluandanhgia: {
//             required: "Please enter number đánh giá hiển thị",
//             max: "Số đánh giá hiển thị từ 1 đến 255",
//             min: "Số đánh giá hiển thị từ 1 đến 255",
//             digits: "Please enter integer"
//         },
//         songuoibaocao: {
//             required: "Please enter  Amount of people báo cáo",
//             max: "Amount of people báo cáo từ 1 đến 255",
//             min: "Amount of people báo cáo từ 1 đến 255",
//             digits: "Please enter integer"
//         },  
//     },
//     submitHandler: function(form) { 
//        form.submit();
//    }
// });






