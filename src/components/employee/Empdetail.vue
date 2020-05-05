<template>
  <div>

    <!-- <div id="empconfirmdelete" class="modal hide fade">
      <div class="modal-body">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div> -->


    <div id="empconfirmdelete" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="padding-bottom:5px;background-color:#f1f1f1;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Delete Confirmation</h3>
          </div>
          <div class="modal-body" style="padding:30px;">
            Are you sure you want to delete the selected employee <span
              style="font-size:16px;"><b>'{{this.emp.EmployeeID}}' </b></span>?<br>
            All related data of the selected employee will also be deleted.
          </div>
          <div class="modal-footer">
            <button @click="deleteemployee()" type="button" data-dismiss="modal" class="btn btn-danger"
              id="delete">Delete</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
          </div>
        </div>
      </div>
    </div>


    <!-- <HEADER ROW WITH HEADING AND COMBO-->
    <!-- ***************************************************** -->
    <div class="row" style="margin:0px;padding:0px;">
      <div class="col-sm-7" style="padding-left:0px;">
        <h2 style=" margin-top: 10px; margin-bottom: 5px; font-size:25px;font-family: 'Helvetica', Arial, sans-serif;">
          Employee Detail  <span class="small" style="margin-left: 16px;"> {{emp.EmployeeID}}</span></h2>

      </div>
      <!-- <empsearchbar/> -->
      <!-- TEST BOOT SELECT -->
      <!-- Bootstrap select https://www.youtube.com/watch?v=lg1d0QaQLe0 -->
      <!-- https://www.webslesson.info/2017/05/bootstrap-multi-select-dropdown-with-checkboxes-using-jquery-in-php.html -->
      <!-- <div class="col-sm-4" style="padding-right:0px;margin-top:0px;margin-left:70px;margin-bottom:9px;">
            <div class="form-group" >
              <div class="col-sm-5" style="height: 30px;padding-top: 3px;padding-left: 7px;margin-left: 178px;margin-bottom: 2px;">
                  <select class="form-control" style="height:33px;width:233px;margin-right:5px;"
                      id="selectemployeeid" 
                      data-live-search="true" 
                      data-style="btn btn-default btn-sm" 
                      data-size="20"
                      data-width="233px"
                      data-none-selected-text="Find an Employee"
                      data-container="body"
                  >
                      <option v-for="item in lstEmpID" :value="item.EmpID">{{ item.EmployeeID }}</option>
                  </select>
              </div>
            </div>
          </div> -->


            <!-- LOADING IMAGE DIV  -->
            <div v-if="loading2" class="loading-container" style="width: 100%;
            background-color: transparent;
            opacity:1;
            position: absolute;
            z-index: 3;
            margin-left: 0%;
            margin-right: 0%;
            margin-top: 0%;
            margin-bottom: 0%;
            height: 84.5%;
            left: 90px;
            padding-top: 80px;">
          <img class="imgloading" style="display: block; margin-left: auto;margin-right: auto;"
            src="/img/loading4.gif" />
        </div>
       <!-- END LOADING IMAGE DIV  -->




      <!-- TEST BOOT SELECT DROPDOWN-->
      <!-- ***************************************************** -->
      <!-- Bootstrap select https://www.youtube.com/watch?v=lg1d0QaQLe0 -->
      <!-- https://www.webslesson.info/2017/05/bootstrap-multi-select-dropdown-with-checkboxes-using-jquery-in-php.html -->
      <!-- For styling and avoiding button going out of container http://jsfiddle.net/MansukhKhandhar/4309n31p/1/ -->
      <div class="input-group my-group pull-right" style="height:32px; width:250px;margin-top:5px;">
        <!-- class form-control and style is added to select to avoid only showing button first on refresh -->
        <!-- note: binding is not used since it needs array to check items -->
        <select id="selectemployeeid" class="form-control" style="height:32px;width:205px;" data-live-search="true"
          data-size="20" title="Find employee ...">
          <option v-for="item in lstEmpID" :value="item.EmpID">{{ item.EmployeeID }}</option>
        </select>
        <span class="input-group-btn">
          <button @click="findbyemployeeid()" class="btn btn-default" style="height:32px;padding-top:4px;">GO</button>
        </span>

      </div>

    </div>
    <!-- End Header row -->



 




    <!-- DETAIL CONTAINER -->
    <!-- ***************************************************** -->
    <div id="details" style="margin-top:0px;">

      <div class="row"
        style="margin-top:0px;margin-left:0px;margin-right:0px;padding:15px;padding-left:10px;border:1px solid #afafaf; border-radius: 4px;">
        <div class="col-sm-4" style="margin-right:0px;">
          <dl class="dl-horizontal">
            <dt>EmployeeID</dt>

            <dd id="ddEmployeeID">
              <!-- https://stackoverflow.com/questions/6584235/django-want-to-display-an-empty-field-as-blank-rather-displaying-none -->
              <!-- {% if not emp.EmployeeID == None %}
              {{emp.EmployeeID}}
              {%endif%}-->

              {{emp.EmployeeID}}
            </dd>
            <dt>Prefix</dt>
            <dd>{{emp.Prefix}}</dd>
            <dt>First Name</dt>
            <dd>{{emp.Firstname}}</dd>
            <dt>Last Name</dt>
            <dd>{{emp.Lastname}}</dd>
            <dt>Middle Initial</dt>
            <dd>{{emp.MiddleI}}</dd>
            <dt>Suffix</dt>
            <dd>{{emp.Suffix}}</dd>
            <dt>Full Name</dt>
            <dd>{{emp.FullName}}</dd>
            <dt>Company Name</dt>
            <dd>{{emp.ComID}}</dd>
            <dt>Employee Status</dt>
            <dd>{{emp.EmployeeStatus}}</dd>
            <dt>Hire Date</dt>
            <dd id="hiredate">{{emp.HireDate}}</dd>
          </dl>
        </div>

        <div class="col-sm-4" style="padding-right:0px;">
          <dl class="dl-horizontal" style=" margin-top:0; margin-bottom:0px;">

            <dt>Department</dt>
            <dd>{{emp.Department}}</dd>
            <dt>Job Title</dt>
            <dd>{{emp.JobTitle}}</dd>
            <dt>Registration</dt>
            <dd>{{emp.Registration}}</dd>
            <dt>Discipline SF330</dt>
            <dd>{{emp.DisciplineSF330}}</dd>
            <dt>Discipline SF254</dt>
            <dd>{{emp.DisciplineSF254}}</dd>
            <dt>Exp. with other firm</dt>
            <dd>{{emp.ExpWithOtherFirm}}</dd>
            <dt>Consultant</dt>
            <dd>
              <!-- {{emp.Employee_Consultant}} -->
              <!-- <input id="ddEmployee_Consultant" disabled="true" class="check-box" type="checkbox" /> -->
              <!-- note: ":true-value="1" should be used to tellchkbox for which value it should be checked -->
              <input id="ddEmployee_Consultant" v-model="emp.Employee_Consultant" :true-value="1" class="check-box"
                type="checkbox" />
            </dd>
            <dt>Created at</dt>
            <dd id="ddcreatedat">{{emp.created_at}}</dd>
            <dt>Updated at</dt>
            <dd id="ddupdatedat">{{emp.updated_at}}</dd>
            <!-- <dt>ImageData</dt>
            <dd id="ddImageData">{{emp.ImageData}}</dd> -->
          </dl>

        </div>
        <div class="col-sm-1" style="padding-right:0px;padding-left:0px;">
          <!-- {% if emp.ImageData %}
                <img
                  class="pull-right"
                  src="{{emp.ImageData.url}}"
                  style="width:150px;"
                  alt
                />
                {% else %}
                <img class="pull-right" src style="width:150px;" alt />
                {% endif %}-->


          <img class="pull-left" :src="'images/empphoto/'+emp.ImageData" style="width:100px;border:0px solid #b6b6b6;"
            alt />
          <!-- <img class="pull-left" :src="'/img/empphoto/'+emp1.ImageData" style="width:100px;border:1px solid #b6b6b6;" alt /> -->

        </div>

        <div class="col-sm-3 pull-right" style="margin-left:0px;padding-right:0px;position:relative">
          <div style="width:100%;"> &nbsp;
            <a @click="backtoemployee()" class="pull-right" style="font-size:14px;color:#006fae;cursor:pointer">Back to
               List </a>
          </div>

          <!--EDIT AND DELETE BUTTONS -->
          <div style="width:100%;padding-top:200px;"> &nbsp;
            <!-- <a @click="empconfirmdelete()" type="button" class="btn btn-default btn-sm pull-right" style="margin-left:6px;color:#006fae;"><span class="glyphicon glyphicon-remove " style="color:#c47676"></span> Delete Employee </a>   -->
            <a @click="empconfirmdelete()" type="button" class="btn btn-danger btn-sm pull-right"
              style="margin-left:6px;width:100px"> Delete</a>
            <!-- <a @click.prevent="deleteemployee()" type="button" class="btn btn-default btn-sm pull-right" style="margin-left:6px;color:#006fae;"><span class="glyphicon glyphicon-remove " style="color:#c47676"></span> Delete Employee </a>   -->
            <!-- <a @click="showempeditmodal()" type="button" class="btn btn-default btn-sm pull-right" style="color:#006fae;"><i class="fa fa-edit" style="font-size:14px;color:green;"></i> Edit Employee</a>   -->
            <a @click="showempeditmodal()" type="button" style="width:100px" class="btn btn-primary btn-sm pull-right"> Edit</a>
            <!-- this hidden btn is clicked by a jquery trigger event to refresh employee -->
            <!-- <button id="refreshemployee" @click="refreshempdetail()" hidden>Refresh Employee</button> -->
          </div>
        </div>

      </div><!--  end detail row -->
    
    </div><!--  end detail container-->
    



    <!-- TAB CONTAINER -->
    <!-- ***************************************************** -->
    <div style="margin-top:20px; ">
      <ul id="navtabs" class="nav nav-tabs">
        <!-- Dynamically load child component on click -->
        <!-- <li class="active" @click="showcomponent">  -->
        <li class="active">
          <a id="empprojectlinktab" data-toggle="tab" href="#empprojecttab">Employee Projects</a>
        </li>
        <li>
          <a id="degreelinktab" data-toggle="tab" href="#degreetab">Degree</a>
        </li>
        <!-- <li @click="showcomponent">   -->
        <li>
          <a id="reglinktab" data-toggle="tab" href="#regtab">Registration</a>
        </li>
      </ul>



      <!-- TAB CONTENT -->
      <!-- ***************************************************** -->
      <div class="tab-content" style="border:1px solid #aeaeae; border-top:none;padding:4px;padding-top:0px;">

        <!-- <div id="degreetab" class="tab-pane fade in  active"> Dynamically load child component-->
        <div id="empprojecttab" class="tab-pane fade in active ">
          <!-- <empdegreetabcontent v-if="showdegree"/> -->
          <!-- <empdegreetabcontent :is="current"></empdegreetabcontent> -->
          <empprojecttabcontent />
          <!-- <empprojecttabcontent/> -->
        </div>

        <!-- <div id="degreetab" class="tab-pane fade in  active"> Dynamically load child component-->
        <div id="degreetab" class="tab-pane fade in  ">
          <!-- <empdegreetabcontent v-if="showdegree"/> -->
          <!-- <empdegreetabcontent :is="current"></empdegreetabcontent> -->
          <empdegreetabcontent />
        </div>
        <!-- end degreetab div -->

        <div id="regtab" class="tab-pane fade in ">
          <!-- <empregtabcontent v-if="showreg"/> Dynamically load child component-->
          <!-- https://stackoverflow.com/questions/48397597/dynamically-add-a-child-component-in-vue-js -->
          <!-- <empregtabcontent :is="current"></empregtabcontent> -->
          <empregtabcontent />
        </div>
        <!-- end regtab div -->

        <empeditmodal ref="editmodalcomponent" v-bind:empid="empid" />
        <!-- global unauthorised message will also worl in tab contents dont need in tabcontents -->
        <!-- <globalunauthorisedmsg /> -->
        <!-- <globaldeletemsg />
        <globaldeletemsgchild /> -->


      </div><!-- end Full tab-content class div -->
      

    </div><!-- end tab container -->
    

    <!-- </div> end main container div -->

    <!-- get empid from emp.id put it in hidden p to pass to jquery -->
    <!-- <p id="hiddenempid" style="display: none">{{emp.id}}</p> -->


  </div>

</template>



<script>

  import empprojecttabcontent from "./empchild/empprojecttabcontent.vue";
  import empdegreetabcontent from "./empchild/empdegreetabcontent.vue";
  import empregtabcontent from "./empchild/empregtabcontent.vue";
  import empeditmodal from "./EmpEditModal.vue";

  // import moment from 'moment';
  // import axios from "axios";
  // import empsearchbar from "./empsearchbar.vue";


  export default {
    name: "empdetail",
    components: {
      empprojecttabcontent,
      empdegreetabcontent,
      empregtabcontent,
      empeditmodal
      // empsearchbar,


      // https://stackoverflow.com/questions/48397597/dynamically-add-a-child-component-in-vue-js
      // show1: empdegreetabcontent,// used to  Dynamically load child component using :is
      // show2: empregtabcontent, // used to  Dynamically load child component using :is


    },
    data() {
      return {

        lstEmpID: [],
        empid: 0,
        cssclass: 'active',
        emp: {},

        // showdegree:false, //used to  Dynamically load child component
        // showreg:false,   //used to  Dynamically load child component
        // current: 'show1' // used to  Dynamically load child component using :is
        // emp1:{ImageData:"Empphoto.jpg"},

        findid: 0,
        loading2:false

      };
    },

    methods: {

      findbyemployeeid() {

        this.findid = $("#selectemployeeid").val();

        // to find detail page for emp but looses history and reloads entire page
        // this :key is used for fid by Employeeid in detail page to avoid whole page reload . This :key will
        // check for any change in route and remount the page without reloading. History is also preserved   -->
        // https://laracasts.com/discuss/channels/vue/vue-2-reload-component-when-same-route-is-requested?page=1 -->
        // this line is added in master.blade.php <router-view :key="$route.fullPath"></router-view>
        this.$router.push({
          name: "empdetail", // name property of this route must be used in route list to use with parameter
          params: { empid: this.findid },
          query: { this: this.findid } // query param is used to pass empid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
        });
      },

      backtoemployee() {
        this.$router.push('employee');
      },

      showempeditmodal() {

        // // since the above cannot be used without latest laravel ver usertype is passed from master.blade in a hidden span 
        // // and used here as prototype to use in all pvue pages
        // var s1=this.$usertype;
        // var s2="admin";
        // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
        //   // alert("You don't have permission to run this operation");
        //   $("#globalunauthorisedmsg").modal("show");
        //   return;
        // } 

        // //to get edit data from databese in child instead of table row
        this.empid = this.emp.EmpID;//$("#hiddenid").val();
        // // console.log(this.empid);
        this.$refs.editmodalcomponent.loadeditdata(this.empid);
        $("#empeditmodal").modal("show");
      },


      empconfirmdelete() {

        // // https://www.youtube.com/watch?v=sW6MStdkFJE using front end permission using Laravel 5.7 ACL in Front-end Using Vue js
        // if (!this.$gate.isAdmin) { // cannot use this since it needs laravel latest ver
        
        var s1 = "admin"; //test blocked//this.$usertype;
        var s2 = "admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
           alert("You don't have permission to run this operation");
          //$("#globalunauthorisedmsg").modal("show");
          return;
        }
        
        $("#empconfirmdelete").modal("show");

        // var text="Are you sure you want to delete the selected employee <span style='font-size:16px;'><b>" + this.emp.EmployeeID + " </b></span>?<br>All related data of the selected employee will also be deleted.";
        // $("#empconfirmdelete").modal("show");
        // $("#deleteconfirmtext").html(text);
        // $("#globaldeletemsg").modal("show");

      },


      deleteemployee() {

        this.loading2 = true;
        // this.empid = $("#hiddenid").val();  // this.empid now set in mounted under table click
        this.empid = this.emp.EmpID;

        this.$axios
          // .post("apiempdeletedata/" + this.empid + "").then((response) => {
            .delete(this.$host+"api/employee/" + this.empid + "").then((response) => {

            iziToast.success({
              title: "Successful",
              position:"topRight",
              message: "Deleted Employee successfully"
            });

            // $('#employeeTable').DataTable().ajax.reload(); // refresh parent table
            this.$router.push('employee');
            this.loading2 = false;
          })
          .catch(err => {
            iziToast.error({
                title: 'Error',
                message: 'Error deleting Employee record',
            });
            this.loading2 = false;
          }); // end catch
      },

      // REFRESH Employee detail if data saved in edit modal
      refreshempdetail() {

        this.loading2 = true;
        this.$axios
          .get(this.$host + "api/employee/empdetails/" + this.empid + "").then(response => {

            this.emp = response.data;

            //Change date format using moment.js 
            if (response.data.HireDate) {
              this.emp.HireDate = this.$moment(response.data.HireDate).format("MM/DD/YYYY");
            } 
            // By default mssql saves '1900-01-01' for empty date. So show blank when date is '1900-01-01'
            if (this.emp.HireDate === '01/01/1900') {
              this.emp.HireDate = '';
            }
            this.loading2 = false;
          })
          .catch(err => {
            iziToast.error({
              title: 'Error',
              message: 'Error loading detail page',
            });
            this.loading2 = false;
          });
      }

      // this.$router.go(this.$router.currentRoute);
      //  var href="/empdetail?this=5"
      //  window.location.href = href;

      //  window.location = this.currentRoute;

      //  var evt = $.Event("keypress");
      //     evt.keyCode = 65;
      //     evt.ctrlKey = true;
      //     evt.shiftKey=true;
      //     $(document).trigger(evt); 




      // // dynamically load child component
      // showcomponent(e){
      //     // this.showdegree=true;
      //     // console.log(e.target.id);
      //     if (e.target.id=='degreelinktab') {
      //       this.showdegree=true;
      //     }
      //     if (e.target.id=='reglinktab') {
      //       this.showreg=true;
      //     }
      //   },

      //  // dynamically load child component ising :is
      // showcomponent(e){
      //     // this.showdegree=true;
      //     // console.log(e.target.id);
      //     if (e.target.id=='degreelinktab') {
      //       this.current='show1';
      //     }
      //     if (e.target.id=='reglinktab') {
      //       this.current='show2';
      //     }
      //   },



    },  // methods



    mounted() {
      // this.loading2 = true;
      // Refresh empmain after edit on modal hide
      // call vue data inside jquery ,no need for hidden element click for indirect call
      // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component
      var self = this; // using vue method in jquery in this way

      $('#empeditmodal').on('hidden.bs.modal', function () {
        self.refreshempdetail();
      })


      // access route parameter value use "this.$route.params.eid"
      this.empid = this.$route.params.empid;

      // get empid from global variable when page is refreshed since previous id is lost and becomes null with refreshed
      if (this.empid == null) {
        // this.empid=this.$empdetailglobalvariable;
        // this.$router.push('employee');
        this.empid = this.$route.query.this;// query param is used to reset empid since empid is lost  when page is refreshed
      }
      // console.log(this.empid);

      this.$axios
        // .get("apiempdetaildata/" + this.empid + "").then(response => {
        .get(this.$host + "api/employee/empdetails/" + this.empid + "").then(response => {

          this.emp = response.data;
          //Change date format using moment.js 
          if (response.data.HireDate) {
            this.emp.HireDate = this.$moment(response.data.HireDate).format("MM/DD/YYYY");
          } else {
            this.emp.HireDate = null;
          }
          if (this.emp.HireDate === '01/01/1900') {
            this.emp.HireDate = '';
          }

          // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'm/d/Y')
          // // to show hiredate in detail modal in mm/dd/yyyy format
          // if (this.emp.HireDate!=null) {
          //     let userDate = this.emp.HireDate;//'1999-02-13 00:00:00';
          //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");
          //     this.emp.HireDate=date_string;
          //     // $("#ddDurationFrom").html('');
          // }
          // if (this.emp.created_at!=null) {
          //     let userDate = this.emp.created_at;//'1999-02-13 00:00:00';
          //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");
          //     this.emp.created_at=date_string;
          //     // $("#ddDurationFrom").html('');
          // }
          // if (this.emp.updated_at!=null) {
          //     let userDate = this.emp.updated_at;//'1999-02-13 00:00:00';
          //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
          //     this.emp.updated_at=date_string;

          //     // $("#ddDurationFrom").html('');
          // }
          // // to show blank in detail modal if date is default '1900-01-01 00:00:00'
          // if (this.emp.HireDate==='01/01/1900') {
          //     this.emp.HireDate="";
          //     // $("#ddDurationFrom").html('');
          // }

          // this.loading2 = false;
        })

        .catch(err => {
          iziToast.error({
              title: 'Error',
              message: 'Error loading detail page',
            });
          // this.loading2 = false;
        });

      // set global variable with empid since when page is refreshed previous id is lost
      // used to get the empid from this variable when detail page is refreshed and previous id is lost

      // console.log(this.$empdetailglobalvariable);
      // console.log(this.$route.query.this)


      // this.$http
      //   .get("/api/apilstEmpID",{
      //     headers: {
      //             'Authorization': this.$apitoken
      //              }
      //         }).then(function(response) {
      //     this.lstEmpID = response.body;
      //   });


      // NOW GLOBAL baseURL and Authorization Header is used
      // axios.get("apilstEmpID").then((response) => {
      this.$axios.get(this.$host + "api/empcombo/emp/employeeid").then((response) => {
        this.lstEmpID = response.data;

        // placed here instead of mounted or $(document).ready else dropdown wont fill after new employee is searched 
        // also use differenr id for each selectpicker to avoid conflict 
        $("#selectemployeeid").selectpicker();

      }).catch((err) => {
        iziToast.error({
            title: 'Error',
            message: 'Error loading detail page',
          });
      });

      // $("#employeeid").text(2);  
      // $('#selectemployeeid option[value="2"]').attr("selected", "selected");

      $(document).ready(function () {
        // $("#lunch").selectpicker(); 

        // $("#selectemployeeid").select(); 

        // $('#selectemployeeid').select({
        //   nonSelectedText: 'Select Framework',
        //   enableFiltering: true,
        //   enableCaseInsensitiveFiltering: true,

        //   includeSelectAllOption: true,
        //   buttonClass: 'showhide',
        //   nonSelectedText: 'Select Secondary Projects',
        //   enableClickableOptGroups: true,
        //   // buttonContainer: '<div style="height: 64px;" />',
        //   // selectAllText: 'Check all!'
        //   // buttonWidth:'400px'
        //   // buttonWidth:'323px'
        // });

      });

      // $('#empeditmodal').on('hidden.bs.modal', function () {
      // // $('#save').click(function () {
      //   $( "#refreshemployee" ).trigger( "click" );
      // })

    }, // end mounted


  };

</script>




<style scoped>


  /*di for detail view==================================================== */
  /* detail views label dt for all views */
  #details dt {
    /* font-family: "Roboto", Arial, Helvetica, sans-serif; */
    font-family: "Helvetica", Arial, sans-serif;
    font-size: 13px !important;
    /* letter-spacing: -0.2px; */
    /* margin-right:-40px; */
    text-align: left;
    /* letter-spacing: -.3px; */
    /* letter-spacing: 0.1px; */
    color: #222222 ;
  }
  /*to align thead dt labels left*/
  .dl-horizontal dt {
    text-align: left;
  }
  dd,dt {
    font-family: "Helvetica", Arial, sans-serif;
    line-height: 1.72857143;
    /* font-family: "Roboto", Arial, Helvetica, sans-serif; */
    font-size: 13px;
  }
  .form-horizontal .control-label {
    text-align: left;
  }
  .col-sm-2 {
    width: 10.6%;
  }


  /*TAB STYLES in detail view====================================== */
  /*TAB Border color*/
  #navtabs {
    border-bottom: 1px solid #aeaeae;
  }
  ul.nav.nav-tabs {
    margin: 0px 0px;
  }
  /*tab height*/
  #navtabs.nav>li>a {
    padding-top: 5px;
    padding-bottom: 5px;
  }
  /*tab content*/
  ul.nav.nav-tabs li:not(.active) a {
    background-color: #eeeeee;
    color: grey;
    border: 1px solid #cdcdcd;
    border-bottom: none;
  }
  ul.nav.nav-tabs li.active a {
    border-top: 3px solid #16a765;
    border-left: 1px solid #aeaeae;
    border-right: 1px solid #aeaeae;
  }
/* Search Combo */
  .input-group .bootstrap-select.form-control .dropdown-toggle {
    border-radius: inherit;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
  }


</style>