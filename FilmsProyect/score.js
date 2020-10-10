class Score {
    constructor(tdScore) {
        this.tdScore = $(tdScore);
        this.imdbID = this.tdScore.attr('data-imdbID');
        this.peticion();
    }

    peticion() {
        $.getJSON('https://www.omdbapi.com/?apikey=6b49aa1f&i=' + this.imdbID).then(this.mostrar.bind(this));
    }

    mostrar(response) {
        var score = response.Ratings[0].Value;
        this.tdScore.text(score);
    }
};

$(function () {
    $('.score').each(function () {
        new Score(this);
    });
});