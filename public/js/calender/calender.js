$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: '/attendance',
        selectable: true,
        selectHelper: true,
        eventRender: function (event, element) {
            var eventTitle = '';
            var startTime = moment(event.created_at).format('HH:mm');
            if (event.type === 2) {
                element.css('background-color', '#2C3E50');
                eventTitle = 'Xin nghỉ (nửa buổi): ';
            } else if(event.type === 1) {
                element.css('background-color', '#007bff');
                eventTitle = 'Xin nghỉ (cả ngày): ';
            }else{
                element.css('background-color', '#ffc107');
                eventTitle = 'Đã điểm danh: '+ startTime + ': ';
            }
            element.find('.fc-title').prepend('<span class="event-type">' + eventTitle + '</span>');

        },
        select: function (start, end, allDay) {
            let exampleModal = new bootstrap.Modal(document.getElementById('myModals'));
            exampleModal.show();
            var submitBtn = document.getElementById('submitBtn');
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
            submitBtn.removeEventListener('click', submitFunction);
            function submitFunction() {
                var selectOption = $('#selectOption').val();
                var selectBreaks = $('#selectBreaks').val();
                var inputAttendes = $('#inputAttendes').val();
                var inputBreaks = $('#inputBreaks').val();
                $.ajax({
                    url: "/attendance/post-calender",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        selectOption: selectOption,
                        selectBreaks: selectBreaks,
                        inputAttendes: inputAttendes,
                        inputBreaks: inputBreaks,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success: function (data) {
                        calendar.fullCalendar('refetchEvents');
                        $('#selectOption').val('');
                        $('#selectBreaks').val('');
                        $('#inputAttendes').val('');
                        $('#inputBreaks').val('');
                        alert(data);
                    }
                })
                submitBtn.removeEventListener('click', submitFunction);
                $('#myModal').modal('hide');
            }
            submitBtn.addEventListener('click', submitFunction);
        },
        editable: true,
        // eventResize: function (event, delta) {
        //     var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
        //     var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
        //     var title = event.title;
        //     var id = event.id;
        //     $.ajax({
        //         url: "/attendance/post-calender",
        //         type: "POST",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             title: title,
        //             start: start,
        //             end: end,
        //             id: id,
        //             type: 'update'
        //         },
        //         success: function (response) {
        //             calendar.fullCalendar('refetchEvents');
        //             alert("Event updated");
        //         }
        //     })
        // },
        // eventDrop: function (event, delta) {
        //     let exampleModal = new bootstrap.Modal(document.getElementById('myModals'));
        //     exampleModal.show();
        //     var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
        //     var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
        //     var title = event.title;
        //     var id = event.id;
        //     $.ajax({
        //         url: "/attendance/post-calender",
        //         type: "POST",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             title: title,
        //             start: start,
        //             end: end,
        //             id: id,
        //             type: 'update'
        //         },
        //         success: function (response) {
        //             calendar.fullCalendar('refetchEvents');
        //             alert("Event updated");
        //         }
        //     })
        // },
        // eventClick: function (event) {
        //     if (confirm("Are you sure you want to remove it?")) {
        //         var id = event.id;
        //         $.ajax({
        //             url: "/attendance/post-calender",
        //             type: "POST",
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             data: {
        //                 id: id,
        //                 type: "delete"
        //             },
        //             success: function (response) {
        //                 calendar.fullCalendar('refetchEvents');
        //                 alert("Event deleted");
        //             }
        //         })
        //     }
        // }
    });
    let selectOption = document.getElementById('selectOption');
    let breaks = document.getElementById('breaks');
    let attendes = document.getElementById('attendes');
    selectOption.addEventListener('change', function(){
        if(selectOption.value ==='0'){
            breaks.style.display="none";
            attendes.style.display="block";
        }else if(selectOption.value==='1'){
            breaks.style.display="block";
            attendes.style.display="none";
        }
    })   
});