document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    const template = document.getElementById('template');
    var eventstart = 0;


    let popperInstance = null;

    var calendar = new FullCalendar.Calendar(calendarEl, {

        locale: 'es',
        editable: true,
        selectable: true,
        default: false,

        // Setting plugins
        plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list', 'bootstrap' ],

        //defaultDate: new Date(2019,8,1),
        //defaultView: 'timeGridWeek',

        businessHours: [ // specify an array instead
            {
              daysOfWeek: [ 1, 2, 3, 4 ], // Monday, Tuesday, Wednesday
              startTime: '12:00', // 8am
              endTime: '20:00' // 6pm
            },
            {
              daysOfWeek: [ 5, 6, 0 ], // Thursday, Friday
              startTime: '10:00', // 10am
              endTime: '22:00' // 4pm
            }
        ],

        // Setting header
        header: {
            left: 'addNewEvent',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
        },

        // Setting footer
        footer: {
            left: '',
            center: '',
            right: 'prevYear prev,next nextYear'
        },

        // Setting bootstrap themes
        themeSystem: 'bootstrap',

        // Getting events from server
        events: url_show,

        // Setting buttons texts
        buttonText: {
            today:    'Today',
            month:    'Mes',
            week:     'Semana',
            day:      'Dia',
            list:     'Lista'
        },

        // Setting custom buttons
        customButtons: {


            // Creating new button
            addNewEvent: {
                text: 'Añadir Cita',
                click: function() {
                    // Clean form fields
                    cleanForm();

                    // Enable star date field
                    $('#start_date').prop('enabled', false);

                    // Setting date and time
                    var date = new Date();
                    var year = date.getFullYear();
                    var month = (date.getMonth()+1);
                    var day = date.getDate();

                    month = (month<10)?"0"+month:month;
                    day = (day<10)?"0"+day:day;

                    $('#start_date').val(year+'-'+month+'-'+day);
                    $('#start_time').val('12:00');
                    $('#end_date').val(year+'-'+month+'-'+day);
                    $('#end_time').val('12:45');

                    // Show hide footer buttons
                    $("#btnAdd").show();
                    $("#btnConf").hide();
                    $("#btnConf").hide();
                    $("#btnEdit").hide();
                    $("#btnDelete").hide();

                    // Show form modal
                    $('#eventModal').modal();
                }
            }
        },

        // Config actions when clicking in a date
        dateClick: function(info) {
            // Clean form fields
            cleanForm();

            // Disable star date field
            $('#start_date').prop('disabled', true);

            // Setting form fields with teh selected date and time
            $('#start_date').val(info.dateStr);
            $('#start_time').val('12:00');
            $('#end_date').val(info.dateStr);
            $('#end_time').val('12:45');

            // Show hide footer buttons
            $("#btnAdd").show();
            $("#btnConf").hide();
            $("#btnEdit").hide();
            $("#btnDelete").hide();

            var f = new Date();
            var year = f.getFullYear();
            var month = f.getMonth() < 10 ? "0" + (f.getMonth() + 1):(f.getMonth() + 1);
            var day = f.getDate() <10 ? "0" + f.getDate():f.getDate();
            var f2 = year +"-"+ month +"-"+ day;
            if ($('#start_date').val() < f2) {
                alert("No se pueden editar citas que ya pasaron");
            }
            else{
                // Show form modal
                $('#eventModal').modal();

                //calendar.addEvent({ title: "Evento X", date:info.dateStr });
            }

        },

        eventMouseout: function (info) {
            //$('#eventModal2').modal('toggle');
        },

        eventMouseEnter: function (info) {
            start_month = (info.event.start.getMonth()+1);
			start_day = info.event.start.getDate();
			start_year = info.event.start.getFullYear();
			start_hours = info.event.start.getHours();
			start_minutes = info.event.start.getMinutes();

			start_month = (start_month<10)?"0"+start_month:start_month;
			start_day = (start_day<10)?"0"+start_day:start_day;
			start_hours = (start_hours<10)?"0"+start_hours:start_hours;
			start_minutes = (start_minutes<10)?"0"+start_minutes:start_minutes;

            // Getting end date and time
			end_month = (info.event.end.getMonth()+1);
			end_day = info.event.end.getDate();
			end_year = info.event.end.getFullYear();
			end_hours = info.event.end.getHours();
			end_minutes = info.event.end.getMinutes();

			end_month = (end_month<10)?"0"+end_month:end_month;
			end_day = (end_day<10)?"0"+end_day:end_day;
			end_hours = (end_hours<10)?"0"+end_hours:end_hours;
            end_minutes = (end_minutes<10)?"0"+end_minutes:end_minutes;


            //alert("No se pueden editar citas que ya pasaron");
            // setting date and time
			$('#id').val(info.event.id),
            $('#title').val(info.event.title),
            $('#paciente').val(info.event.extendedProps.paciente),
            $('#terapeuta').val(info.event.extendedProps.terapeuta),
            $('#start_date').val(start_year+"-"+start_month+"-"+start_day),
            $('#start_time').val(start_hours+":"+start_minutes),
            $('#end_date').val(end_year+"-"+end_month+"-"+end_day),
            $('#end_time').val(end_hours+":"+end_minutes),
            $('#color').val(info.event.backgroundColor),
            $('#description').val(info.event.extendedProps.description);
            $('#estatus').val(info.event.extendedProps.estatus);

            eventstart = start_year+"-"+start_month+"-"+start_day;

            //$('#eventModal2').modal();
        },

        eventDrop: function(info) {
            $('#start_date').prop('disabled', false);

            // Getting start date and time
			start_month = (info.event.start.getMonth()+1);
			start_day = info.event.start.getDate();
			start_year = info.event.start.getFullYear();
			start_hours = info.event.start.getHours();
			start_minutes = info.event.start.getMinutes();

			start_month = (start_month<10)?"0"+start_month:start_month;
			start_day = (start_day<10)?"0"+start_day:start_day;
			start_hours = (start_hours<10)?"0"+start_hours:start_hours;
			start_minutes = (start_minutes<10)?"0"+start_minutes:start_minutes;

            // Getting end date and time
			end_month = (info.event.end.getMonth()+1);
			end_day = info.event.end.getDate();
			end_year = info.event.end.getFullYear();
			end_hours = info.event.end.getHours();
			end_minutes = info.event.end.getMinutes();

			end_month = (end_month<10)?"0"+end_month:end_month;
			end_day = (end_day<10)?"0"+end_day:end_day;
			end_hours = (end_hours<10)?"0"+end_hours:end_hours;
            end_minutes = (end_minutes<10)?"0"+end_minutes:end_minutes;


            //alert("No se pueden editar citas que ya pasaron");
            // setting date and time
			$('#id').val(info.event.id),
            $('#title').val(info.event.title),
            $('#paciente').val(info.event.extendedProps.paciente),
            $('#terapeuta').val(info.event.extendedProps.terapeuta),
            $('#start_date').val(start_year+"-"+start_month+"-"+start_day),
            $('#start_time').val(start_hours+":"+start_minutes),
            $('#end_date').val(end_year+"-"+end_month+"-"+end_day),
            $('#end_time').val(end_hours+":"+end_minutes),
            $('#color').val(info.event.backgroundColor),
            $('#description').val(info.event.extendedProps.description);
            $('#estatus').val(info.event.extendedProps.estatus);

            var f = new Date();
            var year = f.getFullYear();
            var month = f.getMonth() < 10 ? "0" + (f.getMonth() + 1):(f.getMonth() + 1);
            var day = f.getDate() <10 ? "0" + f.getDate():f.getDate();
            var f2 = year +"-"+ month +"-"+ day;
            if (eventstart < f2) {
                alert("No se pueden editar citas que ya pasaron");
                info.revert();
            } else if ( $('#start_date').val() < f2) {
                alert('No se pueden editar citas a fechas pasadas');
                info.revert();
            }
        },
        // Config actions when clicking in an event
        eventClick: function(info) {
            // Enable star date field
            $('#start_date').prop('disabled', false);

            // Getting start date and time
			start_month = (info.event.start.getMonth()+1);
			start_day = info.event.start.getDate();
			start_year = info.event.start.getFullYear();
			start_hours = info.event.start.getHours();
			start_minutes = info.event.start.getMinutes();

			start_month = (start_month<10)?"0"+start_month:start_month;
			start_day = (start_day<10)?"0"+start_day:start_day;
			start_hours = (start_hours<10)?"0"+start_hours:start_hours;
			start_minutes = (start_minutes<10)?"0"+start_minutes:start_minutes;

            // Getting end date and time
			end_month = (info.event.end.getMonth()+1);
			end_day = info.event.end.getDate();
			end_year = info.event.end.getFullYear();
			end_hours = info.event.end.getHours();
			end_minutes = info.event.end.getMinutes();

			end_month = (end_month<10)?"0"+end_month:end_month;
			end_day = (end_day<10)?"0"+end_day:end_day;
			end_hours = (end_hours<10)?"0"+end_hours:end_hours;
            end_minutes = (end_minutes<10)?"0"+end_minutes:end_minutes;

            // setting date and time
			$('#id').val(info.event.id),
            $('#title').val(info.event.extendedProps.idPaciente + " - " + info.event.title),
            $('#paciente').val(info.event.extendedProps.idServicio + " - " + info.event.extendedProps.nombrePaciente),
            $('#telpx').val(info.event.extendedProps.telPaciente),
            $('#nomEsp').val(info.event.extendedProps.nomEsp),
            $('#terapeuta').val(info.event.extendedProps.idEsp + " - " + info.event.extendedProps.nombreEspecialista),
            $('#start_date').val(start_year+"-"+start_month+"-"+start_day),
            $('#start_time').val(start_hours+":"+start_minutes),
            $('#end_date').val(end_year+"-"+end_month+"-"+end_day),
            $('#end_time').val(end_hours+":"+end_minutes),
            $('#color').val(info.event.backgroundColor),
            $('#description').val(info.event.extendedProps.description);
            $('#estatus').val(info.event.extendedProps.estatus);

            var f = new Date();
            var year = f.getFullYear();
            var month = f.getMonth() < 10 ? "0" + (f.getMonth() + 1):(f.getMonth() + 1);
            var day = f.getDate() <10 ? "0" + f.getDate():f.getDate();
            var f2 = year +"-"+ month +"-"+ day;
            if ($('#start_date').val() < f2) {

			$("#btnAdd").hide();
			$("#btnEdit").hide();
            $("#btnDelete").hide();
            $("#btnConf").hide();

            } else {
            // Show hide footer buttons
            $("#btnAdd").hide();
            $("#btnConf").show();
			$("#btnEdit").show();
            $("#btnDelete").show();
            }
            // Show form modal
            $('#eventModal').modal();
        },

        eventRender: function(info) {

            var foto = info.event.extendedProps.fotoPx != null && info.event.extendedProps.fotoPx != "" ? '<img src="../storage/'+info.event.extendedProps.fotoPx+'" width="100" height="100">' +"<br>" : '<img src="/storage/upload-foto/upload-foto/waBT3FddM3HUPI40v5KLPG4foQ1aI1rNsBTGhIbh.jpeg.jpeg" width="100" height="100">' +"<br>";
            tippy(info.el, {
                content:
                foto +
                "Paciente: " + info.event.title + '<br>'
                + "Servicio: " + info.event.extendedProps.nombrePaciente + '<br>'
                + "Tel: " + info.event.extendedProps.telPaciente
                    ,
                allowHTML: true,
                interactive: false,
                hideOnClick: true,
              });
          },

    });

    // Setting calendar language
    calendar.setOption('locale', 'es');

    // Rendering calendar
    calendar.render();


    // Config add actions
    $('#btnAdd').click(function() {
        eventObj = getFormEventData("POST");
        sendInfoEvent('', eventObj);
	})

    // Config edit actions
	$('#btnEdit').click(function() {
        eventObj = getFormEventData("PATCH");
        sendInfoEvent('/'+$('#id').val(), eventObj);
    })

    // Config delete actions
	$('#btnDelete').click(function() {
        eventObj = getFormEventData("DELETE");
        sendInfoEvent('/'+$('#id').val(), eventObj);
	})

    // Getting data from form event modal
    function getFormEventData(method) {

        // Validate date and time
        if (validateDate()) {
            // Creating event data object
            newEventObj = {
                title: $('#title').val(),
                paciente: $('#paciente').val(),
                terapeuta: $('#terapeuta').val(),
                start: $('#start_date').val()+" "+$('#start_time').val(),
                end: $('#end_date').val()+" "+$('#end_time').val(),
                color: $('#color').val(),
                textColor: '#ffffff',
                description: $('#description').val(),
                estatus: $('#estatus').val(),
                '_token': $("meta[name='csrf-token']").attr("content"),
                '_method': method
            }

            return newEventObj;
        } else {
            return
        }
    }

    // Sendind event data object to the action
    function sendInfoEvent(action,eventObj) {
        $.ajax(
            {
                type: "POST",
                url: url_+action,
                data: eventObj,
                success: function(msg){
					$('#eventModal').modal('toggle');
					calendar.refetchEvents();
				},
                error: function(error){
                    console.log(error);
                }
            }
        );
    }

    // Validate date and time
    function validateDate(){
        var f = new Date();
        var year = f.getFullYear();
        var month = f.getMonth() < 10 ? "0" + (f.getMonth() + 1):(f.getMonth() + 1);
        var day = f.getDate() <10 ? "0" + f.getDate():f.getDate();
        var f3 = year +"-"+ month +"-"+ day;
        var f2 = f.getHours() + ":" + f.getMinutes();
        if (($('#start_date').val() === $('#end_date').val())
            && ($('#start_time').val() > $('#end_time').val())) {
            alert("The end time cannot be less than the start time");
        } else if ($('#start_date').val() > $('#end_date').val()) {
            alert("The end date cannot be less than the start date");
        } else if ($('#start_time').val() < f2 && $('#start_date').val() === f3) {
                alert("The start time cannot be less than the current time");
        }else {
            return true;
        }

    }

    // Clean form fields
	function cleanForm() {
		$('#id').val(""),
        $('#title').val(""),
        $('#paciente').val(""),
        $('#terapeuta').val(""),
        $('#description').val(""),
        $('#estatus').val(""),
		$('#color').val(""),
		$('#start_date').val(""),
        $('#start_time').val(""),
        $('#end_date').val(""),
		$('#end_time').val("")
	}
});

