<template>
  <div class="container" style="margin-top:100px;">
    <div class="Cart">
      <div class="Cart__header">
        <div class="Cart__headerGrid">商品</div>
        <div class="Cart__headerGrid">單價</div>
        <div class="Cart__headerGrid">數量</div>
        <div class="Cart__headerGrid">小計</div>
        <div class="Cart__headerGrid">刪除</div>
      </div>

      <div class="Cart__product" data-cartid="" v-for="item in cart ">
                <div class="Cart__productGrid Cart__productImg">
                    <img class="img-fluid"  alt="" srcset="" :src="'../storage/'+item.associatedModel.img">
                </div>
                <div class="Cart__productGrid Cart__productTitle">
                    {{ item.name }}
                </div>
                <div class="Cart__productGrid Cart__productPrice d-flex justify-content-center">$ {{ item.price }}</div>
                <div
                    class="Cart__productGrid Cart__productQuantity d-flex justify-content-center alitem-content-center">
                    <button class="btn1 btn btn-primary" style="padding: 5px" :data-cartid=" item.id " @click="prompt(item.quantity)">-</button>
                    <sapn class="qty1" :data-cartid=" item.id " v-model="item.quantity">{{ item.quantity }}</sapn>
                    <button class="btn2 btn btn-primary" style="padding: 5px" :data-cartid=" item.id " @click="prompt(item.quantity)">+</button>
                </div>
                <div class="Cart__productGrid Cart__productTotal d-flex justify-content-center">
                    {{ item.price * item.quantity}}</div>
                <div class="Cart__productGrid Cart__productDel d-flex justify-content-center">
                    <button class="btn btn-danger" style="padding: 5px" type="button"
                        data-cartid="">X</button>
                </div>
        </div>
        <a href="/cart_check" class="btn btn-sm btn-primary " style="width: 120px">前往結帳</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["cartItem"],
  data: function(){
      return {
          cart : JSON.parse(this.cartItem)
      }
  },
  methods: {
        prompt(aa) {
          $('.qty1[data-cartid]').text(aa + 1);
        }
    },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
