 var adres= 'http://127.0.0.1:8000/';
 function register(e){
        e.preventDefault();
        const user = {
            login: document.forms['registerForm']['login'].value,
            email: document.forms['registerForm']['email'].value,
            haslo: document.forms['registerForm']['haslo'].value,
            imie: document.forms['registerForm']['imie'].value,
            nazwisko: document.forms['registerForm']['nazwisko'].value,
            wiek: document.forms['registerForm']['wiek'].value,
            status: document.forms['registerForm']['status'].value
            
        };
            document.getElementById('status').innerHTML = user.status;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                Object.keys(user).forEach(key => {
                    if(result.hasOwnProperty(key)){
                        document.forms['registerForm'][key].classList.remove('is-valid');
                        document.forms['registerForm'][key].classList.add('is-invalid');
                        document.getElementById(key).innerHTML = result[key];
                     }
                    else{
                   document.forms['registerForm'][key].classList.remove('is-invalid');
                   document.forms['registerForm'][key].classList.add('is-valid');
                   document.getElementById(key).innerHTML = '';
                }
                });
              if(result.success == 'true'){
                window.location.replace(adres+"loginPage");
            }
            }
            
        };
       xmlHttp.open("POST", adres+"user/register", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user)); 
       return false;
        
    
    }
    function logIn(e){
            e.preventDefault();
           const user = {
            login: document.forms['loginForm']['login'].value,
            haslo: document.forms['loginForm']['haslo'].value
        };
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                if(result.success === 'true'){
                    document.forms['loginForm']['login'].classList.remove('is-invalid');
                    document.forms['loginForm']['haslo'].classList.remove('is-invalid');
                    document.getElementById('haslo').innerHTML = '';
                    document.forms['loginForm']['login'].classList.add('is-valid');
                    document.forms['loginForm']['haslo'].classList.add('is-valid');
                    window.location.replace(adres);
                    
                }
                else{
                    document.forms['loginForm']['login'].classList.add('is-invalid');
                    document.forms['loginForm']['haslo'].classList.add('is-invalid');
                    document.getElementById('haslo').innerHTML = 'Login lub hasło są nieprawidłowe';
                }
            }
            };
       xmlHttp.open("POST", adres+"user/login", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user)); 
       return false;
    }
    function editProfile(e, user_id){
        e.preventDefault();
        const user = {
            imie: document.forms['editProfileForm']['imie'].value,
            nazwisko: document.forms['editProfileForm']['nazwisko'].value,
            wiek: document.forms['editProfileForm']['wiek'].value,
            id: user_id
        };
        const check = {imie: '', nazwisko: '', wiek: ''};
            
        
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                Object.keys(check).forEach(key => {
                    if(result.hasOwnProperty(key)){
                        document.forms['editProfileForm'][key].classList.remove('is-valid');
                        document.forms['editProfileForm'][key].classList.add('is-invalid');
                        document.getElementById(key).innerHTML = result[key];
                     }
                    else{
                   document.forms['editProfileForm'][key].classList.remove('is-invalid');
                   document.forms['editProfileForm'][key].classList.add('is-valid');
                    document.getElementById(key).innerHTML = '';
                }
                });
              if(result.success === 'true'){
                window.location.replace(adres+"profile");
            }
            }
            
        };
       xmlHttp.open("POST", adres+"user/editProfile", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user)); 
       return false;
        
    }
    function editPassword(e, user_id){
        e.preventDefault();
        const user = {
            stareHaslo: document.forms['editPasswordForm']['stareHaslo'].value,
            haslo: document.forms['editPasswordForm']['haslo'].value,
            id: user_id
        };
        const check = {stareHaslo: '', haslo: ''};
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                Object.keys(check).forEach(key => {
                    if(result.hasOwnProperty(key)){
                        document.forms['editPasswordForm'][key].classList.remove('is-valid');
                        document.forms['editPasswordForm'][key].classList.add('is-invalid');
                        document.getElementById(key).innerHTML = result[key];
                     }
                    else{
                   document.forms['editPasswordForm'][key].classList.remove('is-invalid');
                   document.forms['editPasswordForm'][key].classList.add('is-valid');
                    document.getElementById(key).innerHTML = '';
                }
                });
              if(result.success === 'true'){
                window.location.replace(adres+"profile");
            }
            }
            
        };
       xmlHttp.open("POST", adres+"user/editPassword", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user)); 
       return false;
    }
    function showProgress(user_id){
        const user = {
            id: user_id
        };
        var labels = ['Waga:', 'Wzrost:', 'Obwód bicepsa:', 'Obwód klatki piersiowej:', 'Data:'];
        var i = 0;
        document.getElementById('wymiary').innerHTML = '';
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                
            result = JSON.parse(this.responseText);
                var zmienna ='';
                $.each(result, function(key, value){
                    zmienna += "<div id='wymiar'>";
                    $.each(value, function(k, v){
                        if( k !== 'id'){
                            if(v !== null){
                               zmienna += labels[i]+" "+v+" "; 
                            }
                            
                            i++;
                        }
                        
                        
                    });
                  zmienna += "<button class='btn btn-dark' onclick='deleteProgress("+value.id+")'>Usuń</button></div>";  
                    i = 0;
                });
                document.getElementById('wymiary').innerHTML = zmienna;
        }
    };
       xmlHttp.open("POST", adres+"user/showProgress", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
    }
    function addProgress(e, user_id){
        e.preventDefault();
        const user = {
          id: user_id,
          waga: document.forms['addProgressForm']['waga'].value,
          wzrost: document.forms['addProgressForm']['wzrost'].value,
          obwod_biceps: document.forms['addProgressForm']['obwod_biceps'].value,
          obwod_klatka: document.forms['addProgressForm']['obwod_klatka'].value,
          data: document.forms['addProgressForm']['data'].value
          
        };
        const check = {
          
          waga: '',
          wzrost: '',
          obwod_biceps: '',
          obwod_klatka: '',
          data: ''
        };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                Object.keys(check).forEach(key => {
                    if(result.hasOwnProperty(key)){
                        document.forms['addProgressForm'][key].classList.remove('is-valid');
                        document.forms['addProgressForm'][key].classList.add('is-invalid');
                        document.getElementById(key).innerHTML = result[key];
                     }
                    else{
                   document.forms['addProgressForm'][key].classList.remove('is-invalid');
                   document.forms['addProgressForm'][key].classList.add('is-valid');
                   document.getElementById(key).innerHTML = '';
                }
                });
                if(result.success == 'true'){
                    window.location.replace(adres+"showProgress");
                }
                

        }
    };
       xmlHttp.open("POST", adres+"user/addProgress", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
        return false;
    }
    function deleteProgress(id_wymiar){
        var r = confirm("Na pewno chcesz usunąć ten wpis?");
        if(r === true){
        const wymiar ={
            id: id_wymiar
        };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                window.location.reload(true);
                

        }
    };
       xmlHttp.open("DELETE", adres+"user/deleteProgress", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(wymiar));
        }
    }
    function showTrainers(pole, kolejnosc, user_id){
        var szukanie;
        if(document.getElementById('szukanie').value === undefined){
            var request = {
                pole: pole,
                kolejnosc: kolejnosc,
                szukanie: 'brak'
            };
        }
        else{
            var request = {
                pole: pole,
                kolejnosc: kolejnosc,
                szukanie: document.getElementById('szukanie').value.toLowerCase()+'%'
        };
        }
        


    
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                result = JSON.parse(this.responseText);
                
                var zmienna =  "<table id='myTable'>";
                Object.entries(result).forEach(([key, val]) =>{
                    zmienna +=  '<tr>';
                    Object.entries(val).forEach(([keey, value])=>{
                        if(value !== null && keey !== 'id'){
                            if(keey === 'wiek'){
                                zmienna +=  '<td>'+ calcAge(value)+'</td>';
                            }
                            else{
                               zmienna +=  '<td>'+value+'</td>'; 
                            }
                            
                        }
                        else{
                            zmienna +=  '<td></td>';
                        }
                    });
                    zmienna += '<td><button class="btn btn-link" onclick="sendRequest('+val.id+','+user_id+')">Wyślij prośbe</button></td>';
                    zmienna +=  '</tr>';
                });
                zmienna+= '</table>';
                document.getElementById('trainers').innerHTML = zmienna;
                }
                

        };
    
       xmlHttp.open("POST", adres+"user/trainerList", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(request));
    }
  function calcAge(dateString) {
    var birthday = +new Date(dateString);
    return ~~((Date.now() - birthday) / (31557600000));
}
function sendRequest(trainer_id, user_id){
    var r = confirm("Na pewno?");
    if(r === true){
    const user ={
      id: user_id,
      trainer: trainer_id
    };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                if(result.success == 'true'){
                    window.location.reload(true);
                }
                

        }
    };
       xmlHttp.open("POST", adres+"user/sendRequest", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
   }
}
function cancelRequest(user_id, second_id){
        var r = confirm("Na pewno?");
        if(r === true){
    const user ={
        id: user_id,
        second_id: second_id
    };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){

                 window.location.reload(true);
                }
    };
       xmlHttp.open("POST", adres+"user/cancelRequest", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
        }
}
function proteges(user_id, akcpt){
    const user ={
        id: user_id,
        akceptacja: akcpt
    };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                 var proteges='<table id="myTable">';
                 result = JSON.parse(this.responseText);

                 Object.entries(result).forEach(([key, value])=>{
                     proteges += '<tr>';
                    Object.entries(value).forEach(([keey, val])=>{
                         if(keey !== 'id'){
                             if(val !== null){
                                 if(keey === 'wiek'){
                                     proteges += '<td>'+calcAge(val)+'</td>';
                                 }
                                 else{
                                 proteges += '<td>'+val+'</td>';
                             }
                                 }
                            else{
                                proteges += '<td></td>';
                                }
                             }

                     });
                     if(akcpt === 'tak'){
                         
                         proteges += '<td><a class = "btn btn-link" href="'+adres+'createSchedule/'+value.id+'"add>Stwórz plan dnia</a><button class="btn btn-link" onclick="cancelRequest('+value.id+', '+user_id+')">Usuń</button></td></tr>';
                     }
                     else{
                         proteges += '<td><button class = "btn btn-link" onclick = "acceptRequest('+value.id+')">Akceptuj</button><button class="btn btn-link" onclick="cancelRequest('+value.id+', 0)">Odrzuć</button></td></tr>';
                     }
                 });
                 proteges += '</table>';
                 document.getElementById('proteges').innerHTML = proteges;
                }
    };
       xmlHttp.open("POST", adres+"user/proteges", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
}

function acceptRequest(user_id){
    const user ={
        id: user_id
    };
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange= function(){
        if(this.readyState === 4 && this.status === 200){
                window.location.reload(true);
                }
    };
       xmlHttp.open("POST", adres+"user/acceptRequest", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
    
}
function showDishes(user_id){
        const user = {
            id: user_id
        };
        var labels = ['Nazwa:', 'Kaloryczność:', 'Opis:'];
        var i = 0;
        document.getElementById('wymiary').innerHTML = '';
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                
            result = JSON.parse(this.responseText);
                var zmienna ='';
                $.each(result, function(key, value){
                    zmienna += "<div id='wymiar'>";
                    $.each(value, function(k, v){
                        if( k !== 'id'){
                            if(v !== null){
                               zmienna += labels[i]+" "+v+" "; 
                            }
                            
                            i++;
                        }
                        
                        
                    });
                  zmienna += "<button class='btn btn-dark' onclick='deleteDish("+value.id+")'>Usuń</button></div>"; 
                    i = 0;
                });
                document.getElementById('wymiary').innerHTML = zmienna;
        }
    };
       xmlHttp.open("POST", adres+"user/showDishes", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
}
    function addDish(e, user_id){
        e.preventDefault();
        const user = {
          id: user_id,
          nazwa: document.forms['addDishForm']['nazwa'].value,
          kalorycznosc: document.forms['addDishForm']['kalorycznosc'].value,
          opis: document.forms['addDishForm']['opis'].value
          
        };
        const check = {
          
          nazwa: '',
          kalorycznosc: '',
          opis: ''

        };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                Object.keys(check).forEach(key => {
                    if(result.hasOwnProperty(key)){
                        document.forms['addDishForm'][key].classList.remove('is-valid');
                        document.forms['addDishForm'][key].classList.add('is-invalid');
                        document.getElementById(key).innerHTML = result[key];
                     }
                    else{
                   document.forms['addDishForm'][key].classList.remove('is-invalid');
                   document.forms['addDishForm'][key].classList.add('is-valid');
                   document.getElementById(key).innerHTML = '';
                }
                });
                if(result.success == 'true'){
                    window.location.replace(adres+"yourDishes");
                }
                

        }
    };
       xmlHttp.open("POST", adres+"user/addDish", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
        return false;
    }
      function deleteDish(id_danie){
        var r = confirm("Na pewno chcesz usunąć to danie?");
        if(r === true){
        const wymiar ={
            id: id_danie
        };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                window.location.reload(true);
                

        }
    };
       xmlHttp.open("DELETE", adres+"user/deleteDish", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(wymiar));
        }
    }
    function showExercises(user_id){
        const user = {
            id: user_id
        };
        var labels = ['Nazwa:', 'Opis:'];
        var i = 0;
        document.getElementById('wymiary').innerHTML = '';
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                
            result = JSON.parse(this.responseText);
                var zmienna ='';
                $.each(result, function(key, value){
                    zmienna += "<div id='wymiar'>";
                    $.each(value, function(k, v){
                        if( k !== 'id'){
                            if(v !== null){
                               zmienna += labels[i]+" "+v+" "; 
                            }
                            
                            i++;
                        }
                        
                        
                    });
                  zmienna += "<button class='btn btn-dark' onclick='deleteExercise("+value.id+")'>Usuń</button></div>"; 
                    i = 0;
                });
                document.getElementById('wymiary').innerHTML = zmienna;
        }
    };
       xmlHttp.open("POST", adres+"user/showExercises", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
}
    function addExercise(e, user_id){
        e.preventDefault();
        const user = {
          id: user_id,
          nazwa: document.forms['addExerciseForm']['nazwa'].value,
          opis: document.forms['addExerciseForm']['opis'].value
          
        };
        const check = {
          
          nazwa: '',
          opis: ''

        };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                
                result = JSON.parse(this.responseText);
                Object.keys(check).forEach(key => {
                    if(result.hasOwnProperty(key)){
                        document.forms['addExerciseForm'][key].classList.remove('is-valid');
                        document.forms['addExerciseForm'][key].classList.add('is-invalid');
                        document.getElementById(key).innerHTML = result[key];
                     }
                    else{
                   document.forms['addExerciseForm'][key].classList.remove('is-invalid');
                   document.forms['addExerciseForm'][key].classList.add('is-valid');
                   document.getElementById(key).innerHTML = '';
                }
                });
                if(result.success == 'true'){
                    window.location.replace(adres+"yourExercises");
                }
                

        }
    };
       xmlHttp.open("POST", adres+"user/addExercise", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
        return false;
    }
    function deleteExercise(id_cwiczenia){
        var r = confirm("Na pewno chcesz usunąć to ćwiczenie?");
        if(r === true){
        const wymiar ={
            id: id_cwiczenia
        };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                window.location.reload(true);
                

        }
    };
       xmlHttp.open("DELETE", adres+"user/deleteExercise", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(wymiar));
        }
    }
function getDishes(e, user_id){
    e.preventDefault();
    const user = {
      id: user_id  
    };
    var zmienna = '';
    var node = document.createElement('div');
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                result = JSON.parse(this.responseText);
                zmienna += '<div class="form-group row"> <label for="danie" class="col-md-2 mb-3 col-form-label font-weight-bold">Danie:</label>\n\
                <div class="col-md-5"><select class = "custom-select" name="danie[]">';
                Object.entries(result).forEach(([key, value])=>{
                    zmienna += '<option value="'+value.id+'">'+value.nazwa+'</option>';
                });
                zmienna += '</select></div></div>';
                node.innerHTML = zmienna;
                var element = document.getElementById('dania');
                element.appendChild(node);
        }
    };
       xmlHttp.open("POST", adres+"user/getDishes", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
        }
function getExercises(e, user_id){
    e.preventDefault();
        const user = {
      id: user_id  
    };
        var zmienna = '';
        var node = document.createElement('div');
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                result = JSON.parse(this.responseText);
                zmienna += '<div class="form-group row"> <label for="danie" class="col-md-2 mb-3 col-form-label font-weight-bold">Ćwiczenie:</label>\n\
                <div class="col-md-5"><select class = "custom-select" name="cwiczenie[]">';
                Object.entries(result).forEach(([key, value])=>{
                    zmienna += '<option value="'+value.id+'">'+value.nazwa+'</option>';
                });
                zmienna += '</select></div></div>'+'<div class="form-group row"><label for="liczba_serii" class="col-md-2 mb-3 col-form-label font-weight-bold">Liczba serii:</label>\n\
                <div class="col-md-5"><input type="number" name="liczba_serii[]" class="form-control"/> </div></div>\n\
                <div class="form-group row"><label for="liczba_powtorzen" class="col-md-2 mb-3 col-form-label font-weight-bold">Liczba powtórzeń:</label>\n\
                <div class="col-md-5"> <input type="number" name="liczba_powtorzen[]" class="form-control"/> </div></div>\n\
                 <div class="form-group row"><label for="obciazenie" class="col-md-2 mb-3 col-form-label font-weight-bold">Obciążenie:</label>\n\
                <div class="col-md-5"> <input type="number" name="obciazenie[]" class="form-control"/> </div></div>';
                node.innerHTML = zmienna;
                var element = document.getElementById('cwiczenia');
                element.appendChild(node);

        }
    };
       xmlHttp.open("POST", adres+"user/getExercises", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
}
function createSchedule(e, user_id){
    getDishes(e, user_id);
    getExercises(user_id);
}
function addSchedule(e, id_trener, id_podopieczny){
    e.preventDefault();
    var dania = document.getElementsByName('danie[]');
    var zmiennaDania = [];
    for(i=0;i<dania.length;i++){
        zmiennaDania[i] = dania[i].value;
    }
    var cwiczenia = document.getElementsByName('cwiczenie[]');
    var powtorzenia = document.getElementsByName('liczba_powtorzen[]');
    var serie = document.getElementsByName('liczba_serii[]');
    var obciazenie = document.getElementsByName('obciazenie[]');
    var zmiennaCwiczenia = [];
    for(i=0;i<cwiczenia.length;i++){
        zmiennaCwiczenia[i] = [cwiczenia[i].value, serie[i].value, powtorzenia[i].value, obciazenie[i].value];
    }
    if(zmiennaDania.length === 0 && zmiennaCwiczenia.lenght === 0){
        window.alert('Musisz dodać danie lub ćwiczenie');
    }
    else{
    const schedule ={
        id_trener: id_trener,
        id_uzytkownik: id_podopieczny,
        data: document.forms['createScheduleForm']['data'].value,
        dania: zmiennaDania,
        cwiczenia: zmiennaCwiczenia
    };
    
            var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                window.location.replace(adres+'proteges');
                window.alert('Utworzono plan dnia');

        }
    };
       xmlHttp.open("POST", adres+"user/createSchedule", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(schedule));
   }
    
    
}
function schedules(user_id){
    const user = {
        id: user_id
    };
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange= function(){
            if(this.readyState === 4 && this.status === 200){
                var zmienna;
                var element = document.getElementById('plany');
                var result = JSON.parse(this.responseText);
                Object.entries(result.plany).forEach(([key, value])=>{
                    var node = document.createElement('div');
                    node.classList.add('okienko');
                    node.tabIndex = 0;
                    zmienna = value.data +'<div id = "wiecej">';
                    if(result.dania !== undefined){
                        zmienna += '<span class="font-weight-bold">DIETA:</span></br>';
                    }
                    Object.entries(result.dania).forEach(([key1, value1])=>{
                       if(value1.plany_dnia_id === value.id){
                           Object.entries(value1).forEach(([key3, value3])=>{
                            if(key3 !== 'plany_dnia_id' && value3 !== null ){
                                switch (key3){
                                    case 'nazwa': key3 = 'Nazwa'; break;
                                    case 'opis': key3 = 'Opis'; break;
                                    case 'kalorycznosc': key3 = 'Kaloryczność'; break;
                                }
                                zmienna += key3 +': ' + value3 +'</br>';
                            }
                       });
                       } 
                    });
                    if(result.cwiczenia !== undefined){
                        zmienna += '<span class="font-weight-bold">TRENING:</span></br>';
                    }
                    Object.entries(result.cwiczenia).forEach(([key2, value2])=>{
                       if(value2.plany_dnia_id === value.id){
                           Object.entries(value2).forEach(([key2, value2])=>{
                            if(key2 !== 'plany_dnia_id' && value2 !== null){
                                switch (key2){
                                    case 'liczba_powtorzen': key2 = 'Liczba powtórzeń'; break;
                                    case 'liczba_serii': key2 = 'Liczba serii'; break;
                                    case 'obciazenie': key2 = 'Obciążenie'; break;
                                    case 'nazwa': key2 = 'Nazwa'; break;
                                    case 'opis': key2 = 'Opis'; break;
                                }
                                zmienna += key2 +': ' + value2 +'</br>';
                            }
                       });
                       } 
                    }); 
                    zmienna += '</div>';
                    node.innerHTML = zmienna;
                    node.addEventListener('focus',function(){
                    this.querySelector('#wiecej').style.display = 'block';
                    }, false);
                    node.addEventListener('blur',function(){
                        this.querySelector('#wiecej').style.display = 'none'; 
                    }, false);
                    if(value.data == new Date().toISOString().slice(0,10)){
                        node.style.border = '#00ff00 solid 1px';
                    }
                    element.appendChild(node);
                    
                });
        }
    };
       xmlHttp.open("POST", adres+"user/showSchedules", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
       xmlHttp.send(JSON.stringify(user));
    
}
function getMessages(user_id, second_id, login){
    const user ={
        id: user_id,
        second_id: second_id
    };
    var myVar = setInterval(function(){
        getNewMessages(user_id, second_id);
    }, 1000);
    var element = document.getElementById('messages');
    element.innerHTML = '';
    if(login !== 0){
        var node = document.createElement('button');
        node.classList.add('btn');
        node.classList.add('btn-light');
        node.classList.add('btn-lg');
        node.classList.add('btn-block');
        node.innerHTML = login;
        node.addEventListener("click", function(){
                    getConversations(user_id);
               });
        document.getElementById('top').style.display = 'block';
        document.getElementById('top').innerHTML = '';
        document.getElementById('top').appendChild(node);
    
    }
    document.getElementById('bottom').style.display = 'block';
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange= function(){
        if(this.readyState === 4 && this.status === 200){
            var form = document.getElementById('wiadomosc');
            form.addEventListener('submit', function(){
               sendMessage(event,user_id, second_id); 
            });
            var result = JSON.parse(this.responseText);

            Object.entries(result).forEach(([key, value])=>{
                var mainNode = document.createElement('div');
               var node = document.createElement('div');
               if(value.id_uzytkownik === user_id){
                   mainNode.classList.add('yourMessage');
                   node.classList.add('sent');
               }
               else{
                  mainNode.classList.add('notYourMessage'); 
                  node.classList.add('received');
               }
               node.innerHTML = value.tresc;
               var dateNode = document.createElement('span');
               dateNode.classList.add('datetime');
               if(value.data.slice(0,10) === new Date().toISOString().slice(0,10)){
                   dateNode.innerHTML = value.data.slice(11,16);
               }
               else{
                   dateNode.innerHTML = value.data.slice(0,16);
               }
               mainNode.appendChild(node);
               mainNode.appendChild(dateNode);
               element.appendChild(mainNode);
               scrollToBottom(element);
               
            });
        }
    };
       xmlHttp.open("POST", adres+"user/getMessages", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
      xmlHttp.send(JSON.stringify(user));
    
}
function sendMessage(e, user_id, second_id){
    e.preventDefault();
    var wiadomosc = {
      id: user_id,
      second_id:second_id,
      tresc: document.getElementById('tresc').value
    };
    document.getElementById('tresc').value = '';
    var element = document.getElementById('messages');
    var mainNode = document.createElement('div');
    var node = document.createElement('div');
    mainNode.classList.add('yourMessage'); 
    node.classList.add('sent');
    node.innerHTML = wiadomosc.tresc;
    var dateNode = document.createElement('span');
    dateNode.classList.add('datetime');
    dateNode.innerHTML = new Date().toLocaleTimeString().slice(0,5);
    mainNode.appendChild(node);
    mainNode.appendChild(dateNode);
    element.appendChild(mainNode);
    scrollToBottom(element);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange= function(){
        if(this.readyState === 4 && this.status === 200){
              
            
        }
    };
       xmlHttp.open("POST", adres+"user/sendMessage", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
      xmlHttp.send(JSON.stringify(wiadomosc));
}
function getConversations(user_id){
    document.getElementById('top').style.display = 'none';
    document.getElementById('bottom').style.display = 'none';
    const user = {
        id:user_id
    };
    
        var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange= function(){
        if(this.readyState === 4 && this.status === 200){
            var result = JSON.parse(this.responseText);
            var element = document.getElementById('messages');
            element.innerHTML = '';
            Object.entries(result).forEach(([key, value])=>{
               var node = document.createElement('button');
               node.classList.add('btn');
               node.classList.add('btn-light');
               node.classList.add('btn-lg');
               node.classList.add('btn-block');
               node.innerHTML = value.login;
               node.addEventListener("click", function(){
                    getMessages(user_id, value.id, value.login);
               });
               element.appendChild(node);
            });
        }
    };
       xmlHttp.open("POST", adres+"user/getConversations", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
      xmlHttp.send(JSON.stringify(user));
}
function getNewMessages(user_id, second_id){
    const user={
        id: user_id,
        second_id: second_id
    };
    var element = document.getElementById('messages');
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange= function(){
        if(this.readyState === 4 && this.status === 200){
            var result = JSON.parse(this.responseText);
            Object.entries(result).forEach(([key, value])=>{
                var mainNode = document.createElement('div');
                var node = document.createElement('div');
                mainNode.classList.add('notYourMessage'); 
                node.classList.add('received');

               node.innerHTML = value.tresc;
               var dateNode = document.createElement('span');
               dateNode.classList.add('datetime');
               if(value.data.slice(0,10) === new Date().toISOString().slice(0,10)){
                   dateNode.innerHTML = value.data.slice(11,16);
               }
               else{
                   dateNode.innerHTML = value.data.slice(0,16);
               }
               mainNode.appendChild(node);
               mainNode.appendChild(dateNode);
               element.appendChild(mainNode);
            });
        }
    };
       xmlHttp.open("POST", adres+"user/getNewMessages", true);
       xmlHttp.setRequestHeader('Content-type', 'application/json');
      xmlHttp.send(JSON.stringify(user));
    
}
function scrollToBottom(e) {
  e.scrollTop = e.scrollHeight - e.getBoundingClientRect().height;
}
    

    


