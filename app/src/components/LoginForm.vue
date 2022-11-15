<script setup>
import { ref } from "vue";
import axios from "axios";
// import { useRouter } from "vue-router";

const username = ref("");
const password = ref("");
const success = ref("");
const unsuccess = ref("");
var msg = [];
// let disabled = [true, true];
const passwordType = ref("password");
let eyePath = require("@/assets/icons/eye-closed.svg");
// const router = useRouter();
const headers = {
  "Content-Type": "application/json",
  "Acess-Control-Allow-Origin": "http://localhost:/8080",
  "Acess-Control-Allow-Credentials": "true",
  "Acess-Control-Allow-Headers":
    "AccountKey,x-requested-with, Content-Type, origin, authorization, accept, client-security-token, host, date, cookie, cookie2",
  "Acess-Control-Allow-Methods": "GET, POST, OPTIONS, PUT, DELETE",
};

// watch(passwordType, (val) => {
//   passwordType.value = val;
// });

const togglePassword = () => {
  if (eyePath === require("@/assets/icons/eye-closed.svg")) {
    eyePath = require("@/assets/icons/eye-open.svg");
  } else {
    eyePath = require("@/assets/icons/eye-closed.svg");
  }
  passwordType.value = passwordType.value === "password" ? "text" : "password";
};

const chkLogin = () => {
  if (username.value !== "" && password.value !== "") {
    // var fd = new FormData();
    // fd.append("username", JSON.stringify(username.value));
    // fd.append("password", JSON.stringify(password.value));
    var fd = new FormData();
    fd.append("username", username.value);
    fd.append("password", password.value);

    // let fd = {
    //   username: username,
    //   password: password,
    // };

    // console.log(fd.get("username"));
    // console.log(fd.get("password"));
    axios
      .post("http://localhost:80/blogmanager/api/login/chkuser", fd, headers)
      .then((resp) => {
        // JSON.parse(this.data);
        //fix the variables
        if (resp.data.response == "success") {
          alert("welcome");
          alert(resp.data.message);
        } else if (resp.data.response == "error") {
          alert(resp.data.message);
        } else {
          alert(resp.data);
          console.log(resp.data);
        }
      })
      .catch((error) => {
        console.log(error);
        alert(error);
      });
  }
};
</script>
<template>
  <div class="bg-wrapper">
    <div class="bg-body">
      <header>
        <img class="bg-img" src="../assets/pz.svg" />
      </header>
      <form @submit.prevent="chkLogin">
        <div>
          <span
            v-if="msg.access"
            class="text-copy"
            :class="{ 'text-green-500': success, 'text-rose-700': unsuccess }"
            >{{ msg.access }}</span
          >

          <label class="lbls" for="username">Username</label>
          <input
            class="userfield"
            type="text"
            name="username"
            v-model="username"
            required
          />
          <span class="text-copy" v-if="msg.username">{{ msg.username }}</span>
        </div>
        <div>
          <label class="lbls" for="password">Password</label>
          <input
            class="passfield"
            :type="passwordType"
            name="password"
            v-model="password"
            required
            autocomplete="off"
          />
          <span class="text-copy" v-if="msg.password">{{ msg.password }}</span>
          <button type="password" @click.stop.prevent="togglePassword">
            <img class="eyes" :src="eyePath" />
          </button>
          <div>
            <button type="submit" class="btn-sub">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<style scoped>
.bg-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #313131;
  height: 100vh;
}
.bg-body {
  width: 100%;
  background-color: #fff;
  padding: 20px;
  margin-top: auto;
  margin-bottom: auto;
  box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
  border-radius: 4px;
  max-width: 512px;
}
.bg-img {
  width: 80px;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 20px;
}
.text-copy {
  font-weight: 700;
  text-align: center;
}
.lbls {
  display: block;
  margin-bottom: 8px;
  font-weight: 700;
}
.userfield {
  width: 100%;
  padding: 8px;
  margin-bottom: 24px;
  outline: none;
  border-color: #b92227;
  border-top-style: hidden;
  border-left-style: hidden;
  border-right-style: hidden;
  border-bottom-width: 2px;
}

.passfield {
  width: 89%;
  padding: 8px;
  margin-bottom: 40px;
  outline: none;
  border-color: #b92227;
  border-top-style: hidden;
  border-left-style: hidden;
  border-right-style: hidden;
  border-bottom-width: 2px;
}
.showpass {
  display: block;
}
.eyes {
  width: 24px;
  height: 24px;
}
.btn-sub {
  width: 100%;
  padding: 8px;
  margin-bottom: 24px;
  padding: 8px 16px;
  border-radius: 4px;
  background-color: #b92227;
  color: #fff;
  outline: none;
}
</style>
