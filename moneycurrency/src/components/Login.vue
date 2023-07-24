<template>
  <section class="login-content-form">
    <div class="form-bg">
      <div class="conteneur">
        <div class="row">
          <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 w-100">
            <div class="form-container">
              <h3 class="title">Currency converter API</h3>
              <form class="form-horizontal" method="post" @submit.prevent="login">
                <div class="form-icon">
                  <i class="fa fa-user-circle"></i>
                </div>
                <div class="form-group">
                  <span class="input-icon"><i class="fa fa-user"></i></span>
                  <input
                    v-model="infosData.email"
                    name="email"
                    type="email"
                    class="form-control"
                    placeholder="Username"
                  />
                </div>
                <div class="form-group">
                  <span class="input-icon"><i class="fa fa-lock"></i></span>
                  <input
                    v-model="infosData.password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                  />
                </div>
                <button type="submit" class="btn signin">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
import "../assets/Login.css"
export default {
  name: "Login",
  data() {
    return {
      infosData: {
        email: "",
        password: "",
      },
      jsonData: null, // Pour stocker la valeur JSON récupérée
      errors: {},
    };
  },
  methods: {
     login(){
        axios.post('http://127.0.0.1:8000/api/login', this.infosData).then((response) => {
          if(response.data.status == 0){
            let jsonData;
            jsonData = response.data.message;
            console.log(response.data)
            window.location.href="/"
          }else {
            localStorage.setItem('token', response.data.access_token)
            window.location.href="/dashbord"
          }

        }).catch((errors) => {
            this.errors = errors.response.data.errors
        })
      },
  },
};
</script>

<style scoped>

.login-content-form {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-content: center;
  align-items: center;
}
.form-bg {
  width: 400px;
}
.conteneur{
  width: 100%;
}
.form-container {
  background: linear-gradient(
    150deg,
    #250360 33%,
    #bbd8f5 34%,
    #a7abab 66%,
    #060d93 67%
  );
  font-family: "Raleway", sans-serif;
  text-align: center;
  padding: 30px 20px 50px;
}
.form-container .title {
  color: #fff;
  font-size: 23px;
  text-transform: capitalize;
  letter-spacing: 1px;
  margin: 0 0 60px;
}
.form-container .form-horizontal {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}
.form-horizontal .form-icon {
  color: #fff;
  background-color: #1b394d;
  font-size: 75px;
  line-height: 92px;
  height: 90px;
  width: 90px;
  margin: -65px auto 10px;
  border-radius: 50%;
}
.form-horizontal .form-group {
  margin: 0 0 10px;
  position: relative;
}
.form-horizontal .form-group:nth-child(3) {
  margin-bottom: 30px;
}
.form-horizontal .form-group .input-icon {
  color: #e7e7e7;
  font-size: 23px;
  position: absolute;
  left: 0;
  top: 10px;
}
.form-horizontal .form-control {
  color: #000;
  font-size: 16px;
  font-weight: 600;
  height: 50px;
  padding: 10px 10px 10px 40px;
  margin: 0 0 5px;
  border: none;
  border-bottom: 2px solid #e7e7e7;
  border-radius: 0px;
  box-shadow: none;
}
.form-horizontal .form-control:focus {
  box-shadow: none;
  border-bottom-color: #3a67c5;
}
.form-horizontal .form-control::placeholder {
  color: #000;
  font-size: 16px;
  font-weight: 600;
}
.form-horizontal .forgot {
  font-size: 13px;
  font-weight: 600;
  text-align: right;
  display: block;
}
.form-horizontal .forgot a {
  color: #777;
  transition: all 0.3s ease 0s;
}
.form-horizontal .forgot a:hover {
  color: #777;
  text-decoration: underline;
}
.form-horizontal .signin {
  color: #fff;
  background-color: #07249b;
  font-size: 17px;
  text-transform: capitalize;
  letter-spacing: 2px;
  width: 100%;
  padding: 12px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  transition: all 0.4s ease 0s;
}
.form-horizontal .signin:hover,
.form-horizontal .signin:focus {
  font-weight: 600;
  letter-spacing: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3) inset;
}
</style>>
