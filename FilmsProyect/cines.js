class Mapa {
    constructor() {
        this.getCoordinates();
        this.googleMapa = new google.maps.Map(document.getElementById('mapa'), {
            center: {
                lat: 43.361914,
                lng: -5.849397
            },
            zoom: 10
        });
    }

    getCoordinates() {
        navigator.geolocation.getCurrentPosition(this.centrarMapa.bind(this));
    }

    aniadirCine(cine) {
        cine.crearMarca(this.googleMapa);
    }

    centrarMapa(g) {
        this.googleMapa.setCenter({
            lat: g.coords.latitude,
            lng: g.coords.longitude
        });
    }
}

class Cine {

    constructor(nombre, latitud, longitud) {
        this.nombre = nombre;
        this.latitud = latitud;
        this.longitud = longitud;
    }

    crearMarca(googleMapa) {
        return new google.maps.Marker({
            position: {
                lat: this.latitud,
                lng: this.longitud
            },
            map: googleMapa,
            animation: google.maps.Animation.DROP,
            title: this.nombre
        });
    }
}

class Cines {

    constructor(mapa) {
        this.mapa = mapa;
        $.get('cines.xml', this.mostrarResultados.bind(this));
    }

    mostrarResultados(r) {
        $('cinema', r).each((i, cine) => {
            var nombre = $(cine).attr('name');
            var latitud = parseFloat($(cine).find('> location > latitude').text());
            var longitud = parseFloat($(cine).find('> location > longitude').text());
            this.mapa.aniadirCine(new Cine(nombre, latitud, longitud));
        });
    }
}

$(function () {
    var mapa = new Mapa();
    new Cines(mapa);
})