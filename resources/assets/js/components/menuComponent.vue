<template>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">LaraVue</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contas a Pagar <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li v-for="menu in menus">
                                <a href="javascript:;" @click="showView(menu.id)"><i class="fa fa-{{ menu.icon }}"></i> {{ menu.name }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</template>


<script>

    export default{
        data(){
            return{
                menus: [
                    {id: 0, name: 'Listar Contas', icon: 'list'},
                    {id: 1, name: 'Criar Conta', icon: 'plus'}
                ],
            }
        },
        methods: {
            showView: function (id) {
                if (id == 1) {
                    this.$parent.formType = 'insert';
                }
                this.$parent.activeView = id;
            },
        }
    }
</script>
