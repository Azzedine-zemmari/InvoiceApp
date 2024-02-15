<script setup>
import axios from 'axios';
import {onMounted,ref} from 'vue'
let form = ref([])
let allCustomers = ref([])
let customer_id = ref([])
const indexForm = async()=>{
    let response = await axios.get('/api/createInvoice')
    // console.log('form',response.data)
    form.value = response.data
}
onMounted( async ()=>{
    indexForm()
    getAllCustomers()
})
const getAllCustomers = async() => {
    let response = await axios.get('/api/customers')
    console.log('response',response)
    allCustomers.value = response.data.customers
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
                    <select name="" id="" class="input">
                        <option value="">cust 1</option>
                    </select>
                </div>
                <div>
                    <p class="my-1">Date</p> 
                    <input id="date" placeholder="dd-mm-yyyy" type="date" class="input"> <!---->
                    <p class="my-1">Due Date</p> 
                    <input id="due_date" type="date" class="input">
                </div>
                <div>
                    <p class="my-1">Numero</p> 
                    <input type="text" class="input"> 
                    <p class="my-1">Reference(Optional)</p> 
                    <input type="text" class="input">
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
                <div class="table--items2">
                    <p>#093654 vjxhchkvhxc vkxckvjkxc jkvjxckvjkx </p>
                    <p>
                        <input type="text" class="input" >
                    </p>
                    <p>
                        <input type="text" class="input" >
                    </p>
                    <p>
                        $ 10000
                    </p>
                    <p style="color: red; font-size: 24px;cursor: pointer;">
                        &times;
                    </p>
                </div>
                <div style="padding: 10px 30px !important;">
                    <button class="btn btn-sm btn__open--modal">Add New Line</button>
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
    <div class="modal main__modal ">
        <div class="modal__content">
            <span class="modal__close btn__close--modal">×</span>
            <h3 class="modal__title">Add Item</h3>
            <hr><br>
            <div class="modal__items">
                <select class="input my-1">
                    <option value="None">None</option>
                    <option value="None">LBC Padala</option>
                </select>
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