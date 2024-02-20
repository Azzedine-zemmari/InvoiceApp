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
            <div>
                <a class="btn btn-secondary">
                    Save
                </a>
            </div>
        </div>
        
    </div>
</div>
</template>