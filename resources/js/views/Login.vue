<template>
  <div class=" flex-r container">
    <div class="flex-r login-wrapper">
      <div class="login-text">
        <div class="logo">
          <span><i class="fab fa-speakap"></i></span>
          <span>Coders</span>
        </div>
        <h1>Sign In</h1>
        <p>It's not long before you embark on this journey! </p>

        <form class="flex-c">
          <div class="input-box">
            <span class="label">E-mail</span>
            <div class=" flex-r input">
              <input type="text" placeholder="name@abc.com">
              <i class="fas fa-at"></i>
            </div>
          </div>

          <div class="input-box">
            <span class="label">Password</span>
            <div class="flex-r input">
              <input type="password" placeholder="8+ (a, A, 1, #)">
              <i class="fas fa-lock"></i>
            </div>
          </div>

          <div class="check">
            <input type="checkbox" name="" id="">
            <span>I've read and agree with T&C</span>
          </div>

          <button class="btn" @click="signIn">Sign In</button>
          <span class="extra-line">
            <span>Already have not an account?</span>
            <a href="#">Sign Up</a>
          </span>
        </form>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from "vue";
import axios from "axios";

let resApi = reactive({
  status: '',
  user: {}
});

// const data = reactive({ user: {} });
const signIn = () => {
  axios.post("/api/login", {
    email: 'minhdt.vietnam@gmail.com',
    password: '123456',
  },{
    withCredentials: true
  }).then((res) => {
    console.log(res.data);
    resApi.status = res.data.status;
    resApi.user = res.data.user;
  }).catch(err => {

  })
}
</script>

<style>
* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

.flex-r,
.flex-c {
  justify-content: center;
  align-items: center;
  display: flex;
}

.flex-c {
  flex-direction: column;
}

.flex-r {
  flex-direction: row;
}

.container {
  width: 100%;
  min-height: 100vh;
  padding: 20px 10px;
  background: #E5E5E5;
}



.login-text {
  background-color: #F6F6F6;
  max-width: 400px;
  min-height: 500px;
  border-radius: 10px;
  padding: 10px 20px;
}

.logo {
  margin-bottom: 20px;
}

.logo span,
.logo span i {
  font-size: 25px;
  color: #0d8aa7;
}

.login-text h1 {
  font-size: 25px;
}

.login-text p {
  font-size: 15px;
  color: #000000B2;
}

form {
  align-items: flex-start !important;
  width: 100%;
  margin-top: 15px;
}

.input-box {
  margin: 10px 0px;
  width: 100%;
}

.label {
  font-size: 15px;
  color: black;
  margin-bottom: 3px;
}

.input {
  background-color: #F6F6F6;
  padding: 0px 5px;
  border: 2px solid rgba(216, 216, 216, 1);
  border-radius: 10px;
  overflow: hidden;
  justify-content: flex-start;
}

input {
  border: none;
  outline: none;
  padding: 10px 5px;
  background-color: #F6F6F6;
  flex: 1;
}

.input i {
  color: rgba(0, 0, 0, 0.4);
}

.check span {
  color: #000000B2;
  font-size: 15px;
  font-weight: bold;
  margin-left: 5px;
}

.btn {
  color: #ffffff;
  border-radius: 30px;
  padding: 10px 15px;
  background: linear-gradient(122.33deg, #68bed1 30.62%, #1E94E9 100%);
  margin-top: 30px;
  margin-bottom: 10px;
  font-size: 16px;
  transition: all 0.3s linear;
}

.btn:hover {
  transform: translateY(-2px);
}

.extra-line {
  font-size: 15px;
  font-weight: 600;
}

.extra-line a {
  color: #0095B6;
}
</style>
