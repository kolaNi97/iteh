        google.load('visualization', '1.0', {'packages':['corechart']});
        google.setOnLoadCallback(iscrtaj);

        function iscrtaj() {
            var jsonData = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json",
                dataType:"json",
                async: false
            }).responseText;

            var a = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=1",
                dataType:"json",
                async: false
            }).responseText;

            var b = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=2",
                dataType:"json",
                async: false
            }).responseText;

            var c = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=3",
                dataType:"json",
                async: false
            }).responseText;

            var d = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=4",
                dataType:"json",
                async: false
            }).responseText;

            var e = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=5",
                dataType:"json",
                async: false
            }).responseText;
            var f = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=6",
                dataType:"json",
                async: false
            }).responseText;

            var g = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=7",
                dataType:"json",
                async: false
            }).responseText;

            var h = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=8",
                dataType:"json",
                async: false
            }).responseText;

            var i = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=9",
                dataType:"json",
                async: false
            }).responseText;

            var j = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=10",
                dataType:"json",
                async: false
            }).responseText;

            var k = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=11",
                dataType:"json",
                async: false
            }).responseText;

            var l = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=12",
                dataType:"json",
                async: false
            }).responseText;

            var m = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=13",
                dataType:"json",
                async: false
            }).responseText;

            var n = $.ajax({
                url: "http://localhost/projekat/vizuelizacija.json?reziser=14",
                dataType:"json",
                async: false
            }).responseText;

            var data = new google.visualization.DataTable(jsonData);
            var data1 = new google.visualization.DataTable(a);
            var data2 = new google.visualization.DataTable(b);
            var data3 = new google.visualization.DataTable(c);
            var data4 = new google.visualization.DataTable(d);
            var data5 = new google.visualization.DataTable(e);
            var data6 = new google.visualization.DataTable(f);
            var data7 = new google.visualization.DataTable(g);
            var data8 = new google.visualization.DataTable(h);
            var data9 = new google.visualization.DataTable(i);
            var data10 = new google.visualization.DataTable(j);
            var data11 = new google.visualization.DataTable(k);
            var data12 = new google.visualization.DataTable(l);
            var data13 = new google.visualization.DataTable(m);
            var data14 = new google.visualization.DataTable(n);


            var options = {'title': 'Prikaz filmova',
                           'hAxis': {title: 'Trajanje',  titleTextStyle: {color: 'black', fontSize: 18}},
                           'width':800,
                           'height':545,
                           'colors': ['blue']
                          };
          var chart = new google.visualization.BarChart(document.getElementById("chart_div"));

            // Funkcija događaja
            function dogadjaj() {
                var selectedItem = chart.getSelection()[0];
                if(selectedItem) {
                    var film = data.getValue(selectedItem.row, 0);
                    var trajanje = data.getValue(selectedItem.row, 1);
                    alert('Film: '+ film +', Trajanje: '+ trajanje +' kom ');
                }
            }

            // Dodavanje osluškivača za klik događaj
            var listenerHandle = google.visualization.events.addListener(chart, 'select', dogadjaj);
            chart.draw(data,{width: 800, height: 1000,   title: 'Prikaz filmova',colors:['blue']});

            var buttonVizualizacija = document.getElementById('buttonVizualizacija');
            buttonVizualizacija.onclick = function() {
                var lista = document.forma.reziser.selectedIndex;
                var izabranReziser = document.forma.reziser.options[lista].value;
                if(izabranReziser == null) {
                    chart.draw(data, options);
                    listenerHandle = google.visualization.events.addListener(chart, 'select', dogadjaj);
                };
                if(izabranReziser == '1') {
                    chart.draw(data1, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '2') {
                    chart.draw(data2, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '3') {
                    chart.draw(data3, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '4') {
                    chart.draw(data4, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '5') {
                    chart.draw(data5, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '6') {
                    chart.draw(data6, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '7') {
                    chart.draw(data7, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '8') {
                    chart.draw(data8, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '9') {
                    chart.draw(data9, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '10') {
                    chart.draw(data10, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '11') {
                    chart.draw(data11, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '12') {
                    chart.draw(data12, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '13') {
                    chart.draw(data13, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranReziser == '14') {
                    chart.draw(data14, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
            }
        }
