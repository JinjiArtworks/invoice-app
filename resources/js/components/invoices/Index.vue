
<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
let invoices = ref([]);
let searchInvoices = ref([]);
// method
const getInvoices = async () => {
    let response = await axios.get("/api/invoice");
    invoices.value = response.data.invoices;
};
const search = async () => {
    let response = await axios.get(
        "/api/searchInvoice?s=" + searchInvoices.value
    );
    // data.invoices; invoices= reference ke return response json yg ada di controller
    invoices.value = response.data.invoices;
    console.log(response);
};
const newInvoice = async () => {
    router.push("/invoice/new"); // redirect to new page name new
};
const onShow = (id) => {
    router.push('/invoice/show/' + id)
}
onMounted(async () => {
    getInvoices(); // di onMOunted kan agar dapat di foreach datanya utk ditampilkan. search ini kan tidak wajib tampil kalo ga diisi
});
</script>
<template>
    <div class="container">
        <div class="invoices">
            <div class="card__header">
                <div>
                    <h2 class="invoice__title">Invoices</h2>
                </div>
                <div>
                    <a class="btn btn-secondary" @click="newInvoice()">
                        New Invoice
                    </a>
                </div>
            </div>

            <div class="table card__content">
                <div class="table--filter">
                    <span class="table--filter--collapseBtn">
                        <i class="fas fa-ellipsis-h"></i>
                    </span>
                    <div class="table--filter--listWrapper">
                        <ul class="table--filter--list">
                            <li>
                                <p class="table--filter--link table--filter--link--active">
                                    All
                                </p>
                            </li>
                            <li>
                                <p class="table--filter--link">Paid</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table--search">
                    <div class="table--search--wrapper">
                        <select class="table--search--select" name="" id="">
                            <option value="">Filter</option>
                        </select>
                    </div>
                    <div class="relative">
                        <i class="table--search--input--icon fas fa-search"></i>
                        <input class="table--search--input" v-model="searchInvoices" @keyup="search()" type="text"
                            placeholder="Search invoice" />
                    </div>
                </div>

                <div class="table--heading">
                    <p>ID</p>
                    <p>Date</p>
                    <p>Number</p>
                    <p>Customer</p>
                    <p>Due Date</p>
                    <p>Total</p>
                </div>

                <!-- item 1 -->
                <div class="table--items" v-for="(item, index) in invoices" :key="index">
                    <a href="" class="table--items--transactionId" @click="onShow(item.id)">#{{ item.id }}</a>
                    <p>{{ item.date }}</p>
                    <p>#{{ item.number }}</p>
                    <!-- how to use ORM model  -->
                    <p>{{ item.customer.firstname }}</p>
                    <p>{{ item.due_date }}</p>
                    <p>{{ item.total }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Modal title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

