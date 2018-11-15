 function initMap() 
 {
        var uluru = {lat: 47.518939, lng: 25.861876};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
}

document.write("<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAi3CZFmObhcrMNZeyDtGr2Zt6vOiX5fEc&callback=initMap'><\/script>");