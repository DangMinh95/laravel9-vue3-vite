<template>
  <div class="login">
    <div class="container">
      <label for="uname"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" v-model="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" v-model="password" required>

      <p class="errorMessage" v-if="data.errorCode !== 0">{{ data.message }}</p>
      <button @click="signIn">Login</button>
      <div style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import router from "../router";

export default {
  name: 'Login.vue',
  data() {
    return {
      email: '',
      password: '',
      data: {}
    }
  },
  methods: {
    signIn() {
      axios.post("/api/login", {
        email: this.email,
        password: this.password,
      }).then(({data}) => {
        this.data = data;
        if (data.errorCode === 0) {
          router.push({name: 'product'})
        }
      });
    }
  }
}
</script>
<style scoped>
.errorMessage {
  color: red;
}

.login {
  position: relative;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

form {
  border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.container {
  width: 500px;
  position: absolute;
  top: 200px;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }

  .cancelbtn {
    width: 100%;
  }
}
</style>
