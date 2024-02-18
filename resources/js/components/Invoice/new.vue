<script setup>
import axios from 'axios';
import {onMounted,ref} from 'vue'
let form = ref([])
let allCustomers = ref([])
let customer_id = ref([])
let item = ref([])
let listCart = ref([])
let showModel = ref(false)
let hiddeModel = ref(true)
let productList = ref([])
const indexForm = async()=>{
    let response = await axios.get('/api/createInvoice')
    // console.log('form',response.data)
    form.value = response.data
}
    onMounted( async ()=>{
        indexForm()
        getAllCustomers()
        getProduct()
    })
const getAllCustomers = async() => {
    let response = await axios.get('/api/customers')
    console.log('response',response)
    allCustomers.value = response.data.customers
}
const addCart = (item)=>{
        const itemCart = {
            id:item.id,
            item_code:item.item_code,
            Description:item.description,
            unit_price:item.unit_price,
            quantity:item.quantity,  
        }
        listCart.value.push(itemCart)
}
const openModel =()=>{
showModel.value = !showModel.value
}
const closeModel = ()=>{
    showModel.value = !hiddeModel.value
}
const getProduct = async() =>{
    let response = await axios.get('/api/products')
    console.log('product',  response)
    productList.value= response.data.product
}

</script>
<template>
<div class="container">
    <div class="invoices">
        
        <div class="card__header">
            <div>
                <h2 class="invoice__title">New Invoice</h2>
            </div>
            <div>
                
            </div>
        </div>
    
        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Customer</p>
                    <select name="" id="" class="input" v-model="customer_id">
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
                <div class="table--items2" v-for="(itemCart,i) in listCart" :key="itemCart.id">
                    <p>#{{ itemCart.item_code }} {{ itemCart.Description }}</p>
                    <p>
                        <input type="text" class="input" v-model="itemCart.unit_price" >
                    </p>
                    <p>
                        <input type="text" class="input" v-model="itemCart.quantity">
                    </p>
                    <p v-if="itemCart.quantity">
                        $ {{ itemCart.quantity * itemCart.unit_price }}
                    </p>
                    <p v-else></p>
                    <p style="color: red; font-size: 24px;cursor: pointer;">
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
                    <textarea cols="50" rows="7" class="textarea" ></textarea>
                </div>
                <div>
                    <div class="table__footer--subtotal">
                        <p>Sub Total</p>
                        <span>$ 1000</span>
                    </div>
                    <div class="table__footer--discount">
                        <p>Discount</p>
                        <input type="text" class="input">
                    </div>
                    <div class="table__footer--total">
                        <p>Grand Total</p>
                        <span>$ 1200</span>
                    </div>
                </div>
            </div>
    
           
        </div>
        <div class="card__header" style="margin-top: 40px;">
            <div>
                
            </div>
            <div class="footerSave">
                <a class="btn btn-secondary">
                    Save
                </a>
                <router-link class="btn btn-light btn__close--modal" to="/">Back home</router-link>
            </div>
        </div>
        
    </div>
    <!--==================== add modal items ====================-->
    <div class="modal main__modal "   :class="{show:showModel}">
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
                <button class="btn btn-light mr-2 btn__close--modal">
                    Cancel
                </button>
                <button class="btn btn-light btn__close--modal ">Save</button>
            </div>  
            

        </div>
    </div>
</div>
</template>