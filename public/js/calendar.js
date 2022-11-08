document.addEventListener('DOMContentLoaded', function() {
  
  var myModal = new bootstrap.Modal(document.getElementById('event'))
  let form = document.getElementById("form");

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'es',
    allDaySlot: false,
    selectable:true,
    headerToolbar: {
      left:'prev,next,today',
      center:'title',
      right:'dayGridMonth,timeGridWeek,timeGridDay'
    },
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    drop: function(arg) {
        console.log(arg.dateStr);
        var event = calendar.getEventById('a')
        console.log(event);
      // is the "remove after drop" checkbox checked?
      if (document.getElementById('drop-remove').checked) {
        // if so, remove the element from the "Draggable Events" list
        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
      }
    },
    events:{
      url: 'http://localhost:8000/event/show',
      color: 'yellow',   // an option!
      textColor: 'black', // an option!
      backgroundColor: 'red',
      borderColor: 'blue'
    },
    
    dateClick:function(info){
      form.reset();
      form.start.value=info.dateStr;
      form.end.value=info.dateStr;
      myModal.show()
    },

    eventClick:function(info){
      var event = info.event;
      
      axios.post("http://localhost:8000/event/edit/"+info.event.id).
      then(
        (response)=>{
          form.id.value= response.data.id;
          // form.service_id.value= response.data.service_id;
          // form.client_id.value= response.data.client_id;
          form.description.value= response.data.description;
          form.title.value= response.data.title;
          form.start.value= response.data.start;
          form.end.value= response.data.end;
          myModal.show()
        }
      ).catch(
        error=>{
          if(error.response){
            console.log(error.response.data);
          }
        }
      );
    },

    eventDrop: function(info) {
    //  const id = info.event.id;
      form.id.value= info.event.id;
      form.title.value= info.event.title;
      form.description.value= info.event.description;
      form.start.value= info.event.startStr;
      const data= new FormData(form);
      console.log(info.event.startStr);
      axios.post("http://localhost:8000/event/update/"+info.event.id,data).
      then(
        (response)=>{
          console.log(response);
          calendar.refetchEvents();
        //  form.id.value= response.data.id;
        //  form.start.value= response.data.start;
        //  form.end.value= response.data.end;
        //   $("#event").modal("show");
        }
      ).catch(
        error=>{
          if(error.response){
            console.log(error.response.data);
          }
        }
      );
    }
  });
  calendar.render();

    document.getElementById("btnSave").addEventListener("click",function() {
      
      sendData("/event/add")
    });

    document.getElementById("btnDelete").addEventListener("click",function() {
      
      sendData("/event/delete/"+form.id.value)
    });

    document.getElementById("btnUpdate").addEventListener("click",function() {
      
      sendData("/event/update/"+form.id.value)
    });

    function sendData(url) {
      const data= new FormData(form);
      console.log(data.title);
      const newURL = baseURL+url;

      axios.post(url,data).
      then(
        (response) =>{
          console.log(response);
          calendar.refetchEvents();
          myModal.hide()
        }
      ).catch(
        error=>{
          if(error.response){
            console.log(error.response.data);
          }
        }
      );
    }

  });

  // {
  //   start:info.event.startStr,
  //   end: info.event.startStr,
  //   }