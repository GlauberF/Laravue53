<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>{{ title }}</h1>
                <small class="text-{{ status | formatStatus bills }}">{{ status }}</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="#" class="btn btn-primary btn-sm" @click.prevent="newBill"> Nova Conta</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Vencimento</th>
                    <th>Nome</th>
                    <th>Paga?</th>
                    <th>Ações</th>
                    <th class="text-right">Valor</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(idx, bill) in bills" :class="{'bg-danger': isOverDue(bill)}">
                    <td>{{ idx + 1 }}</td>
                    <td>{{ bill.due_date | formatDate 'L' 'pt-br' }}</td>
                    <td>{{ bill.name }}</td>
                    <td :class="{'text-success':bill.done, 'text-danger':!bill.done}">{{ bill.done | doneLabel }}</td>
                    <td>
                        <a href="#" @click.prevent="loadBill(bill)" class="btn btn-info btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>
                        <a href="#" @click.prevent="payBill(idx)" class="btn btn-success btn-xs" v-show="bill.done == 0"><i class="fa fa-dollar fa-fw"></i> Pagar</a>
                        <a href="#" @click.prevent="unpayBill(idx)" class="btn btn-warning btn-xs" v-show="bill.done == 1"><i class="fa fa-warning fa-fw"></i> Desfazer Pagamento</a>
                        <a href="#" @click.prevent="removeBill(bill)" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-fw"></i> Apagar Conta</a>

                    </td>
                    <td class="text-right">{{ bill.value | currency 'R$ ' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>


    export default{
        data(){
            return{
                title: 'Contas a Pagar',
                bills: [

                ]
            }
        },
        methods: {
            loadBill(bill) {
                this.$parent.bill = bill;
                this.$parent.formType = 'update';
                this.$parent.activeView = 1;
            },
            payBill(idx) {
                var bill = this.bills[idx];

                this.$http.put('api/bills/' + bill.id + '/pay', bill)
                    .then((response) => {
                        bill.done = 1;
                    })
                    .catch((response, status, request) => {
                        bill.done = 0;
                    });
            },
            unpayBill(idx) {
                var bill = this.bills[idx];

                this.$http.put('api/bills/' + bill.id + '/unpay', bill)
                    .then((response) => {
                        bill.done = 0;
                    })
                    .catch((response) => {
                    });
            },
            removeBill(bill) {
                var result = confirm('Tem certeza?');
                if (result) {
                    this.$http.delete('api/bills/' + bill.id, bill)
                        .then((response) => {
                            this.bills.$remove(bill);
                        })
                        .catch((response) => {
                            alert(response.data);
                        });

                }
                this.$parent.activeView = 0
            },
            isOverDue(bill) {
                var today = moment.now(),
                    due_date = moment(bill.due_date);

                return (due_date < today) && (!bill.done);
            },
            newBill() {
                this.$parent.formType = 'insert';
                this.$parent.bill = {
                    name: '',
                    due_date: moment.now(),
                    value: 0,
                    done: 0
                };
                this.$parent.$children[2].formErrors = {};
                this.$parent.activeView = 1;
            }
        },
        computed: {
            status() {

                if (!this.bills.length) {
                    return "Nenhuma conta cadastrada!";
                }

                var count = 0;

                for(var i in this.bills) {
                    if (!this.bills[i].done) {
                        count++;
                    }
                }

                switch (count) {
                    case 0:
                        return "Nenhuma conta a pagar";
                    case 1:
                        return "Há uma conta a ser paga";
                    default:
                        return "Há " + count + " contas a serem pagas";
                }
            },
        },
        beforeCompile() {
            this.$http.get('api/bills')
                .then((response) => {
                    var results = response.data,
                        vm = this;
                    $.each(JSON.parse(results), function(index, bill) {
                        vm.bills.push(bill);
                    });

            });
        }
    }
</script>
