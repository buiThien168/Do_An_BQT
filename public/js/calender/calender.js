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
            if(event.title===null){
                element.css('background-color', 'red');
            }else{
                element.css('background-color', 'green');
            }
        },
        select: function (start, end, allDay) {
             var title = prompt('Nội dung công việc:');
            if (title) {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url: "/attendance/post-calender",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success: function (data) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event created");
                    }
                })
            }
        },
        editable: true,
        eventResize: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: "/attendance/post-calender",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success: function (response) {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event updated");
                }
            })
        },
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: "/attendance/post-calender",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success: function (response) {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event updated");
                }
            })
        },
        eventClick: function (event) {
            if (confirm("Are you sure you want to remove it?")) {
                var id = event.id;
                $.ajax({
                    url: "/attendance/post-calender",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                        type: "delete"
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event deleted");
                    }
                })
            }
        }
    });
    function getBirthdayListFromServer() {
        var birthdayList = [];
        $.ajax({
            url: '/attendance',
            type: 'GET',
            async: false,
            success: function (data) {
                birthdayList = data;
            },
        });
        return birthdayList;
    }
    getBirthdayListFromServer();
});