<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link to="admin/acceuil">
                    <p class="navbar-brand"><img src="../../public/img/logo.png" alt="Logo du site"></p>
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <form class="d-flex">
                        <p class="m-4"><router-link to="admin/acceuil">
                                Home
                            </router-link>
                        </p>
                        <div class="dropdown m-3">
                            <p class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                WIlfried
                            </p>
                            <ul class="dropdown-menu">
                                <li><router-link to="/admin/profil">
                                        <p class="dropdown-item">Profile</p>
                                    </router-link></li>
                                <li><router-link to="/admin/allusers">
                                        <p class="dropdown-item">Les utilisateurs</p>
                                    </router-link>
                                </li>
                                <li><router-link to="admin/allcomments"><a class="dropdown-item">Les
                                            commentaires</a></router-link></li>
                            </ul>
                        </div>
                        <button class="btn btn-rounded btn-danger btn-sm"><font-awesome-icon icon="right-from-bracket" />
                            <strong>Deconnexion</strong></button>
                    </form>
                </div>
            </div>
        </nav>
        <!--Fin de navbar-->
        <br>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
a {
    text-decoration: none;
}

.cdb-form {
    height: 200px;
    padding: 5%;
}

input[type=text] {
    background-color: #fff;
    width: 30% !important;
    display: block;
    margin-left: auto;
    margin-right: auto;
    font-weight: bold;
    border: #fff;

}

#form-center {
    margin-left: 33%;
    background-color: #fff;
    height: 43px;
    border-top: 1px solid #fff;
}

.card {
    border: 1px solid black;
    background-color: rgb(202, 202, 194);
    ;
}
</style>