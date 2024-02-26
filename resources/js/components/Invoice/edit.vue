<script setup>
import axios from 'axios';
import { onMounted,ref } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter()
let form = ref({
    id:'',
})
let allCustomers = ref([])
let customer_id = ref([])
let showModel = ref(false)
let hiddeModel = ref(true)
let productList = ref([])
const props = defineProps({
    id:{
        type:String,
        default:''
    }
})

onMounted(async()=>{
    getInvoice()
    getAllCustomers()
    getProduct()
})
const openModel =()=>{
showModel.value = !showModel.value
}
const closeModel = ()=>{
    showModel.value = !hiddeModel.value
}
const getInvoice = async()=>{
    let response = await axios.get(`/api/edit_Invoice/${props.id}`)
    //console.log('form',response.data.invoice)
    form.value = response.data.invoice
}
const getAllCustomers = async() => {
    let response = await axios.get('/api/customers')
    //console.log('response',response)
    allCustomers.value = response.data.customers
}
const removeItem = (id,i)=>{
    form.value.invoice_items.splice(i, 1)
    if(id != undefined ){
        axios.get('/api/delete_invoice_items' + id)
        //console.log('form',form.value.invoice_items)
    }
}
const getProduct = async() =>{
    let response = await axios.get('/api/products')
    //console.log('product',  response)
    productList.value= response.data.product
}
const addCart = (item)=>{
        const itemCart = {
            product_id:item.id,
            item_code:item.item_code,
            Description:item.description,
            unit_price:item.unit_price,
            quantity:item.quantity,  
        }
        //listCart.value.push(itemCart)
        form.value.invoice_items.push(itemCart)
        closeModel()
}
const subTotal = () =>{
    let  total = 0
    if(form.value.invoice_items){
        form.value.invoice_items.map(data=>{
            total = total + (data.quantity*data.unit_price)
        })
    }
    return total
}
const Total = ()=>{
    if(form.value.invoice_items){
        return subTotal()-form.value.discount
    }
}
const onEdit = (id) => {
    if(form.value.invoice_items.length>=1){
        // alert(JSON.stringify(form.value.invoice_items))
        let subtotal = subTotal();
            let total = Total();

            const formData = new FormData();
            formData.append('invoice_item', JSON.stringify(form.value.invoice_items));
            formData.append('number', form.value.number);
            formData.append('customer_id',form.value.customer_id);
            formData.append('date', form.value.date);
            formData.append('due_date', form.value.due_date);
            formData.append('reference', form.value.reference);
            formData.append('terms_and_condition', form.value.terms_and_condition);
            formData.append('sub_total', subtotal);
            formData.append('discount', form.value.discount);
            formData.append('total', total);

            axios.post(`/api/updateInvoice/${form.value.id}`, formData);
            form.value.invoice_items = [];
            router.push('/');
    }
}
</script>
<template>
<div class="container">
    <div class="invoices">
        
        <div class="card__header">
            <div>
                <h2 class="invoice__title">Edit Invoice</h2>
            </div>
            <div>
                
            </div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Customer</p>
                    <select name="" id="" class="input" v-model="form.customer_id">
                        <option value="" disabled>Select option</option>
                        <option :value="customer.id" v-for="customer in allCustomers" :key="customer.id">
                        {{ customer.firstname }}
                        </option>
                    </select>
                </div>
                <div>
                    <p class="my-1">Date</p> 
                    <input id="date" placeholder="dd-mm-yyyy" type="date" class="input" v-model="form.date"> <!---->
                    <p class="my-1">Due Date</p> 
                    <input id="due_date" type="date" class="input" v-model="form.due_date">
                </div>
                <div>
                    <p class="my-1">Numero</p> 
                    <input type="text" class="input" v-model="form.number"> 
                    <p class="my-1">Reference(Optional)</p> 
                    <input type="text" class="input" v-model="form.reference">
                </div>
            </div>
            <br><br>
            <div class="table">

                <div class="table--heading2">
                    <p>Item Description</p>
                    <p>Unit Price</p>
                    <p>Qty</p>
                    <p>Total</p>
                    <p></p>
                </div>
    
                <!-- item 1 -->
                <div class="table--items2" v-for="(item,i) in form.invoice_items" :key="item.id">
                    <p v-if="item.product"
                    >#0{{ item.product.item_code }} {{ item.product.description }}</p>
                    <p v-else>{{ item.item_code }} {{ item.description }}</p>
                    <p>
                        <input type="text" class="input" v-model="item.unit_price">
                    </p>
                    <p>
                        <input type="text" class="input" v-model="item.quantity">
                    </p>
                    <p>
                        $ {{ item.quantity * item.unit_price }}
                    </p>
                    <p style="color: red; font-size: 24px;cursor: pointer;" @click="removeItem(item.id,i)">
                        &times;
                    </p>
                </div>
                <div style="padding: 10px 30px !important;">
                    <button class="btn btn-sm btn__open--modal" @click="openModel()">Add New Line</button>
                </div>
            </div>

            <div class="table__footer">
                <div class="document-footer" >
                    <p>Terms and Conditions</p>
                    <textarea cols="50" rows="7" class="textarea" v-model="form.terms_and_condition"></textarea>
                </div>
                <div>
                    <div class="table__footer--subtotal">
                        <p>Sub Total</p>
                        <span>$ {{ subTotal() }}</span>
                    </div>
                    <div class="table__footer--discount">
                        <p>Discount</p>
                        <input type="text" class="input" v-model="form.discount ">
                    </div>
                    <div class="table__footer--total">
                        <p>Grand Total</p>
                        <span>${{ Total() }} </span>
                    </div>
                </div>
            </div>


        </div>
        <div class="card__header" style="margin-top: 40px;">
            <div>
                
            </div>
            <div>
                <a @click="onEdit(form.id)" class="btn btn-secondary">
                    Save
                </a>
            </div>
        </div>
        
    </div>
    <div class="modal main__modal "  :class="{show:showModel}">
        <div class="modal__content">
            <span class="modal__close btn__close--modal" @click="closeModel()">×</span>
            <h3 class="modal__title">Add Item</h3>
            <hr><br>
            <div class="modal__items">
                <ul style="list-style: none;">
                <li v-for="(item,i) in productList" :key='item.id' style="display:grid;grid-template-columns: 30px 350px 15px; align-items:center;padding-bottom:5px">
                    <p>{{ i+1 }}</p>
                    <a href="#">{{ item.item_code }} {{ item.description }}</a>
                    <button @click="addCart(item)" style="border:1px solid #e0e0e0; width:35px; height: 35px;">+</button>
                </li>
            </ul>
            </div>
            <br><hr>
            <div class="model__footer">
                <button class="btn btn-light mr-2 btn__close--modal" @click="closeModel()">
                    Cancel
                </button>
                <button class="btn btn-light btn__close--modal " >Save</button>
            </div>
        </div>
    </div>
</div>
</template>