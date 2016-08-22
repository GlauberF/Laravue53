<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>{{ formTitle }}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form @submit.prevent="submitBill" class="form form-horizontal" role="form">
                <div class="form-group" :class="{'has-error' : formErrors['name']}">
                    <label class="control-label col-sm-3">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" v-model="bill.name" name="name" >
                        <span v-if="formErrors['name']" class="text-danger">{{ formErrors['name'] }}</span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error' : formErrors['value']}">
                    <label class="control-label col-sm-3">Valor</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" v-model="bill.value" name="value" >
                        <span v-if="formErrors['value']" class="text-danger">{{ formErrors['value'] }}</span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error' : formErrors['due_date']}">
                    <label class="control-label col-sm-3">Vencimento</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" v-model="bill.due_date" name="due_date" >
                        <span v-if="formErrors['due_date']" class="text-danger">{{ formErrors['due_date'] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <button type="button" class="btn btn-danger btn-sm" @click="$root.$children[0].$children[0].showView(0)">Voltar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


<script>

    export default{
        props: ['bill', 'formType'],
        data() {
            return {
                formErrors: {}
            };
        },
        computed: {
            formTitle() {
                return this.formType == 'insert' ? 'Nova Conta a Pagar' : 'Editar Conta a Pagar';
            }
        },
        methods: {
            submitBill() {
                if (this.formType == 'insert') {
                    this.$http.post('api/bills', this.bill)
                        .then((response) => {
                            this.$parent.$children[1].bills.push(this.bill);
                            this.$parent.activeView = 0;
                        })
                        .catch((response, status, request) => {
                            this.formErrors = JSON.parse(response.data);
                        });

                }

                if (this.formType == 'update') {
                    this.$http.put('api/bills/' + this.bill.id, this.bill)
                            .then((response) => {
                                this.$parent.activeView = 0;
                            })
                            .catch((response, status, request) => {
                                this.formErrors = JSON.parse(response.data);
                            });
                }

            },
        }
    }
</script>
