<template>
  <div>

    <!-- <div v-if="loading2" class="loading-container" style="width: 100%;
    background-color: blue;
    opacity:1;
     position: absolute;
    z-index: 2;
    margin-left: 0%;
    margin-right: 0%;
    margin-top: 0%;
    margin-bottom: 0%;
    height: 84.5%;
    padding-top: 20px;">
            <img class="imgloading" style="display: block; margin-left: auto;margin-right: auto;"
              src="../../public/img/loading4.gif" />
          </div> -->






    <!-- <h1>Login</h1>
    <button type="button" @click="gotoDashboard()">CLick</button>-->
    <!-- <h1 v-if="test">{{ user.username }}</h1> -->

    <div class="container"
      style="width: 400px;background-color: white;margin-top: 150px; border: 1px solid grey; padding: 20px;padding-top: 10px;">

      <div v-if="loading2" class="loading-container"
        style="width:360px;background-color: transparent;opacity:1;position: absolute;z-index: 2;">
        <img class="imgloading" style="display: block; margin-left: auto;margin-right: auto;"
          src="../../public/img/loading4.gif" />
      </div>

      <h2 style="margin-top: 10px;margin-bottom: 20px;font-weight: bold;">Login</h2>

      <div id="logintoperrbar"
        style="height:0; padding:0px;margin-bottom: 10px;border-radius: 4px; color: #721c24;background-color: #f8d7da;border-color: #f5c6cb; transition: height .3s;margin-bottom:15px;">
        {{formerrors}}
      </div>

      <form id="loginform" v-on:submit.prevent="signin()">
        <div class="form-group">
          <input v-model="user.email" class="form-control" placeholder="email" type="text" name="email" id="email" />
        </div>
        <div class="form-group">
          <input v-model="user.password" class="form-control" placeholder="password" type="password" name="password"
            id="password" />
        </div>
        <button type="submit" class="btn btn-primary pull-right" style="width: 120px;margin-top:20px">Sign in</button>
      </form>
    </div>
  </div>
</template>

<script>
  //   export default{
  //     methods:{
  //       gotoDashboard(){
  //         this.$router.push({name: "dashboard"});
  //       }
  //     }
  //   }
  export default {
    name: "Login",
    data() {
      return {
        // msg: 'Welcome to Your Vue.js App'
        user: {
          email: "",
          password: ""
        },
        employee: { view: 0, add: 0, edit: 0, delete: 0, search: 0 },
        project: { view: 0, add: 0, edit: 0, delete: 0, search: 0 },
        listitems: { view: 0, add: 0, edit: 0, delete: 0, search: 0 },
        test: true,
        loading2: false,
        formerrors: "",
      };
    },
    methods: {
      setRoles() {
        //  this.$store.state.$employee1 = this.employee;
        //  this.$store.state.$project1 = this.project;
        //  this.$store.state.$listitems1 =this.listitems;
      },
      // signin: function() {
      //   if (this.user.username == "") {
      //     // alert("Logged In");
      //     //Todo: Save JWT Token to the Local Storage
      //     this.$router.push({ name: "dashboard" });
      //   } else {
      //     alert("Failed");
      //   }
      // }

      getuserroles($userid) {
        this.$axios.get(this.$host + "api/userrole/" + $userid).then(response => {
          // console.log(response.data.length);
          var i = 0;
          for (let i = 0; i < response.data.length; i++) {
            // const element = response.data[i];

            if (response.data[i].modulename == "employee") {
              // this.$employee["view"] = response.data[i].view;
              // this.$employee["add"] = response.data[i].add;
              // this.$employee["edit"] = response.data[i].edit;
              // this.$employee["delete"] = response.data[i].delete;
              // this.$employee["search"] = response.data[i].search;
              // this.$employee=this.employee;
              // this.employee.view = response.data[i].view;
              // this.employee.add = response.data[i].add;
              // this.employee.edit = response.data[i].edit;
              // this.employee.delete = response.data[i].delete;
              // this.employee.search = response.data[i].search;

              localStorage.setItem("empview", response.data[i].view);
              localStorage.setItem("empadd", response.data[i].add);
              localStorage.setItem("empedit", response.data[i].edit);
              localStorage.setItem("empdelete", response.data[i].delete);
              localStorage.setItem("empsearch", response.data[i].search);
            }
            if (response.data[i].modulename == "project") {
              localStorage.setItem("projectview", response.data[i].view);
              localStorage.setItem("projectadd", response.data[i].add);
              localStorage.setItem("projectedit", response.data[i].edit);
              localStorage.setItem("projectdelete", response.data[i].delete);
              localStorage.setItem("projectsearch", response.data[i].search);
            }
            if (response.data[i].modulename == "listitems") {
              localStorage.setItem("listitemsview", response.data[i].view);
              localStorage.setItem("listitemsadd", response.data[i].add);
              localStorage.setItem("listitemsedit", response.data[i].edit);
              localStorage.setItem("listitemsdelete", response.data[i].delete);
              localStorage.setItem("listitemssearch", response.data[i].search);
            }
          }

          // console.log(response.data);
          // this.userroles["empview"]=response.data[0].permission;
          // this.userroles["empedit"]=response.data[1].permission;
          // this.userroles["empdelete"]=response.data[2].permission;
          // this.userroles["empadd"]=response.data[3].permission;
          // console.log( this.userroles["empview"]);
          // console.log( this.userroles["empedit"]);
          // console.log( this.userroles["empdelete"]);
          // console.log( this.userroles["empadd"]);
          // console.log( this.userroles);
        });
      },


      signin(){
         this.$router.push({ name: "home" });
      },


      // signin() {

      //   this.loading2 = true;

      //   var frm = $("#loginform");

      //   // this.$axios.post("http://localhost:8000/api/login", frm.serialize()).then(response => {
          
      //   this.$axios
      //     // .post(this.$host + "api/login", frm.serialize())
      //     .post(this.$host + "api/users/login", frm.serialize())
      //     // .post("https://ksepnode.herokuapp.com/api/users/login", frm.serialize())
      //     .then(response => {
      //       this.user = response.data;

      //       if (response.data.access_token != null) {

      //         localStorage.setItem("token", response.data.access_token);
      //         localStorage.setItem("username", response.data.user.name);
      //         console.log(response.data.user.name);
      //         // this.getuserroles(response.data.user.id);
      //         // this.setRoles();
      //         // this.$store.state.test = "FROM SIGNIN";
      //         // localStorage.setItem("userrole", {
      //         //   'empview': true,
      //         //   'empedit': false,
      //         //   'empadd' : true,
      //         //   'empdelete':false,
      //         // }
      //         // );

      //         this.$axios.defaults.headers.common["Authorization"] ="Bearer" + localStorage.getItem("token");
      //         this.$axios.defaults.headers.common["Accept"] = "application/json";
      //         this.$router.push({ name: "home" });
      //         this.loading2 = false;

      //       } else {
      //         alert(response.data); // THIS IS FOR WRONG PASSWORD WHERE token IS NOT RECEIVED
      //         this.loading2 = false;
      //       }
            
      //     })
      //     // **NOTE: All response with status 400,401,403,422,500 goes in the catch automatically
      //     // which can be stored using "err.response.data". other msgs with 200 status goes 
      //     // in "then" block above automatically which can be stored using "response.data"
      //     .catch(err => {

      //       // for status 422 and 400 use custom messages written in server under "errors" array
      //       if (err.response.status === 422 || err.response.status===400) {
      //         this.formerrors=err.response.data.errors[0].msg;
      //         this.loading2 = false;
      //         $("#logintoperrbar").css({"height": 45 + "px","padding":10 + "px","border":"1px solid #ffb4bb"});
      //         $("#emptoperrbar").css({"height": height + "px","border":"1px solid red"});
      //       } 

      //       // All other errors 401,403,500 use defautl message from server(err.response.statusText) for the status code           
      //        else  {
      //         this.formerrors="Error status "+ err.response.status+" : "+err.response.statusText;
      //         this.loading2 = false;
      //         $("#logintoperrbar").css({"height": 40 + "px","padding":10 + "px"});
      //       }    
            

      //     });

      //     // 
          
          
      // }//Sigin End

    }
  };
</script>