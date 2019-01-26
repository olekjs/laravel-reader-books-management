<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <label>Wyszukaj książkę</label>
                        <input type="text" class="form-control" v-model="searchValue">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-secondary button-submit-style" @click="getBooks()">Szukaj</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="results" v-if="book.length != 0">
            <div class="jumbotron mt-2">
                <div class="row">
                    <div class="col-md-4">
                        <img :src="book.photo" style="max-width: 310px; height: 480px;" />
                    </div>
                    <div class="col-md-8">
                        <h1 class="display-4">{{ book.title }}</h1>
                        <p class="lead">Autor: {{ book.author }}</p>
                        <p class="lead">Kategoria: {{ book.category }}</p>
                        <p class="lead">Gatunek: {{ book.genres }}</p>
                        <hr class="my-4">
                        <p class="lead">
                            <h4>Dodaj książkę:</h4>
                            <a class="btn btn-outline-primary btn-lg" @click="addToCurrentlyRead()">Do schowka</a>
                            <a class="btn btn-outline-primary btn-lg" @click="addToClipboard()">Do schowka jako przeczytaną</a>
                            <a class="btn btn-outline-primary btn-lg"  v-if="book.link_to_txt" :href="'' + book.title">Czytaj</a>
                        </p>
                    </div>
                </div>
            </div>
            <h3>Podobne książki</h3>
            <hr class="my-4">
            <div class="similar" v-for="similarBook in book.children">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img :src="similarBook.cover" style="max-width: 280px; height: 430px;" />
                            </div>
                            <div class="col-md-8">
                                <p><strong style="font-size: 120%;">{{ similarBook.title }}</strong></p>
                                <p>Gatunek: <strong>{{ similarBook.genre }}</strong></p>
                                <p>Rodzaj: <strong>{{ similarBook.kind }}</strong></p>
                                <p>
                                    <a class="btn btn-outline-primary" @click="getSimilarBook(similarBook.slug)">Szukaj tej książki</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <notifications group="foo" position="bottom right" width="500"/>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                searchValue: '',
                book: [],
            }
        },
        methods: {
            // generateSlug: function() {
            //     return this.book.title.replace(/ /g,'-').replace(/[^\w-]+/g,'');
            // },
            getBooks: function(){
                axios.post('/api/getBook', {
                    title: this.searchValue,
                }).then((response) => {
                    if(response.data.code == '404'){
                        this.$notify({
                            group: 'foo',
                            title: 'Nie znaleziono książki.',
                            duration: 1000,
                            type: 'warn',
                        });
                    } else {
                        this.book = response.data;
                    }
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił bląd podczas wyszukiwania książki.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
            getSimilarBook: function(slug) {
                axios.post('/api/getBook', {
                    title: slug,
                }).then((response) => {
                    this.book = response.data;
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił bląd podczas wyszukiwania książki.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
            addToCurrentlyRead: function() {
                axios.post('/api/addToCurrentlyRead', {
                    book: this.book,
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie dodano książkę do schowka.',
                        duration: 1000,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas dodawania książki do schowka.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
            addToClipboard: function() {
                axios.post('/api/addToClipboard', {
                    book: this.book,
                }).then((response) => {
                     this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie dodano książkę do schowka jako przeczytaną.',
                        duration: 1000,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas dodawania książki do schowka.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
        }
    }
</script>

<style>
    .button-submit-style {
        margin-top: 30px;
    }
</style>