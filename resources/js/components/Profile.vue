<template>
    <div>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-4">
                    <div class="header-photo preview" v-if="this.view == 'preview'">
                        <img :src="linkToPhoto" class="header-photo-settings"/>
                    </div>
                    <div class="header-photo preview" v-else>
                        <label>Link do zdjęcia:</label>
                        <input type="text" class="form-control" v-model="linkToPhoto">
                        <img :src="linkToPhoto" class="header-photo-settings"/>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="header-name preview" v-if="this.view == 'preview'">
                        <h1 class="display-4">{{ fullName }}</h1>
                    </div>
                    <div class="header-name edit" v-else>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Imię:</label>
                                <input type="text" class="form-control" v-model="firstName">
                            </div>
                            <div class="col-md-6">
                                <label>Nazwisko:</label>
                                <input type="text" class="form-control" v-model="lastName">
                            </div>
                        </div>
                    </div>
                    <div class="header-address preview" v-if="this.view == 'preview'">
                        <p class="lead">{{ fullAddress }}</p>
                    </div>
                    <div class="header-address edit" v-else>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Miasto:</label>
                                <input type="text" class="form-control" v-model="city">
                            </div>
                            <div class="col-md-6">
                                <label>Państwo:</label>
                                <input type="text" class="form-control" v-model="country">
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="content-about-me preview" v-if="this.view == 'preview'">
                        <h4>O mnie</h4>
                        <p>{{ this.aboutMe }}</p>
                    </div>
                    <div class="content-about-me edit" v-else>
                        <label>O mnie:</label>
                        <textarea cols="2" class="form-control" v-model="aboutMe"></textarea>
                    </div>
                    <hr class="my-4">
                    <div class="content-favorite-books preview" v-if="this.view == 'preview'">
                        <h4>Ulubione książki</h4>
                        <p>{{ this.favoriteBooks }}</p>
                    </div>
                    <div class="content-favorite-books edit" v-else>
                        <label>Ulubione książki:</label>
                        <textarea cols="2" class="form-control" v-model="favoriteBooks"></textarea>
                    </div>
                    <hr class="my-4">
                    <div class="content-statistic">
                        <h4>Statystyki</h4>
                        <p>{{ this.statistics.accountDays }} dni na Świat czytania</p>
                        <p>{{ this.statistics.readBooks }} przeczytane książki</p>
                        <p>{{ this.statistics.postedPosts }} opublikowanych postów</p>
                    </div>
                </div>
            </div>
            <div class="change-view-button text-right">
                <div class="preview-buttons" v-if="this.view == 'preview'">
                    <button class="btn btn-primary" @click="changeToEdit()">Edytuj profil</button>
                    <a href="friend/user" class="btn btn-primary">Pokaż znajomych</a>
                </div>
                <div class="preview-buttons" v-else>
                    <button class="btn btn-primary" @click="saveChanges()">Zapisz</button>
                    <button class="btn btn-primary" @click="changeToPreview()">Wyjdź z edycji profilu</button>
                </div>
            </div>
        </div>
        <notifications group="foo" position="bottom right" width="500"/>
    </div>
</template>

<script>
    export default {
        props: ['user', 'statistics'],
        data () {
            return {
                view: 'preview',
                linkToPhoto: this.user.photo,
                firstName: this.user.first_name,
                lastName: this.user.last_name,
                city: this.user.city,
                country: this.user.country,
                aboutMe: this.user.about_me,
                favoriteBooks: this.user.favorite_books,
            }
        },
        computed: {
            fullName: function() {
                return `${this.firstName} ${this.lastName}`;
            },
            fullAddress: function() {
                return `${this.city}, ${this.country}`;
            }
        },
        methods: {
            changeToEdit: function() {
                this.view = 'edit';
            },
            changeToPreview: function() {
                this.view = 'preview';
            },
            saveChanges: function() {
                axios.post('/api/saveProfile', {
                    user_id: this.user.user_id,
                    firstName: this.firstName,
                    lastName: this.lastName,
                    city: this.city,
                    country: this.country,
                    aboutMe: this.aboutMe,
                    favoriteBooks: this.favoriteBooks,
                    linkToPhoto: this.linkToPhoto,
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie zapisano profil.',
                        duration: 1000,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas zapisywania profilu.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
        }
    }
</script>

<style>
    .header-photo-settings {
        max-width: 250px;
        max-height: 250px;
    }
    @media (max-width: 1199.98px) {
        .header-photo-settings {
            max-width: 200px;
            max-height: 200px;
        }
    }

    @media (max-width: 991.98px) {
        .header-photo-settings {
            max-width: 160px;
            max-height: 160px;
        }
    }
    @media (max-width: 575.98px) { 
        .header-photo-settings {
            max-width: 150px;
            max-height: 150px;
        }
    }
</style>
