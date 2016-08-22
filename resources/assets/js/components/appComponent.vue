<template>
    <menu-component></menu-component>

    <div class="container" v-show="activeView == 0">
        <bill-list-component></bill-list-component>
    </div>

    <div class="container" v-show="activeView == 1">
        <bill-create-component v-bind:bill="bill" v-bind:form-type="formType"></bill-create-component>
    </div>
</template>


<script>
    import menuComponent from './menuComponent.vue'
    import billListComponent from './billListComponent.vue'
    import billCreateComponent from './billCreateComponent.vue'

    export default{
        data(){
            return {
                activeView: 0,
                formType: 'insert',
                bill: {
                    name: '',
                    due_date: new Date(),
                    value: 0,
                    done: 0
                }
            }
        },
        components:{
            'menu-component': menuComponent,
            'bill-list-component': billListComponent,
            'bill-create-component': billCreateComponent
        }
    }
</script>
