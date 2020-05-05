<template>
  <div >

<!-- Start Confirm Delete Modal ********************************************* -->
    <div id="empregconfirmdelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom:5px;background-color:#f1f1f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Delete Confirmation</h3>
                </div>
                <div class="modal-body" style="padding:30px;">
                    Are you sure you want to delete the selected registration <span style="font-size:16px;"><b>'{{empreg.Registration}}'</b></span><br> 
                    from employee registration of employee <span style="font-size:16px;"><b> '{{empreg.EmpID}}' </b> </span>?
                </div>
                <div class="modal-footer">
                    <button @click="deleteempreg()" type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                    <button  type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>


<!-- Start Detail Modal ********************************************* -->
  <div class="modal fade" id="empregdetailmodal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content " style="width:550px">

        <div
          class="modal-header" style="background-color: #f1f1f1; border-radius: 5px 5px 0 0;  border-bottom: 1px solid lightgrey;  height: 52px; ">
          <button @click="modalclosed"  type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Employee Registration Detail</h4>
        </div>

        <div class="modal-body" id="details" style="padding:30px;padding-top:20px; padding-bottom:0px;">
      
          <dl class="dl-horizontal" style="margin-bottom:10px;" >
            <!-- <dt>EmployeeID</dt>

            <dd id="ddEmployeeID"> -->
              <!-- https://stackoverflow.com/questions/6584235/django-want-to-display-an-empty-field-as-blank-rather-displaying-none -->
              <!-- {% if not emp.EmployeeID == None %}
              {{emp.EmployeeID}}
              {%endif%}-->
          <!-- {{proteam.EmployeeID}} -->
              <!-- {{emp.EmployeeID}} -->
            <!-- </dd> -->


            <dt>Registration</dt>
            <dd>{{empreg.disRegistration}}</dd>
            <dt>Registration State</dt>
            <dd>{{empreg.disRegState}}</dd>
            <dt>Country</dt>
            <dd>{{empreg.disCountry}}</dd>
            <dt>Registration No.</dt>
            <dd >{{empreg.RegistrationNo}}</dd>
            <dt>Registration Year</dt>
            <dd>{{empreg.RegYear}}</dd>
            <dt>Registration Issue Date</dt>
            <dd >{{empreg.RegIssueDate}}</dd>
            <dt>Registration Expiry Date</dt>
            <dd>{{empreg.RegExpDate}}</dd>
            <dt>Created at</dt>
            <dd>{{empreg.created_at}}</dd>

            <dt>Updated at</dt>
            <dd>{{empreg.updated_at}}</dd>   
            <dt>Notes</dt>
            <dd >{{empreg.Notes}}</dd>

          </dl>

      </div>
      <!--  end detail and modal body-->`

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      <!-- end modal-footer -->

      </div>
      <!-- modal-content -->
    </div>
    <!-- end div modal dialog -->
  </div>
  <!-- End Detail Modal ********************************************************-->

<!-- Start Edit Modal ********************************************* -->
  <div class="modal fade" id="empregmodal" role="dialog">
    <div class="modal-dialog" style="width:630px">
      <!-- Modal content-->
      <div class="modal-content">
        <div
          class="modal-header "
          style="background-color: #f1f1f1; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 52px; "
        >
          <button @click="modalclosed"  type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">Edit Registration</h4> -->
           <h4 class="modal-title" v-if="addmode">Add Registration</h4>
           <h4 class="modal-title" v-else>Edit Registration</h4>
        </div>
        <form
          class="form-horizontal"
          enctype="multipart/form-data"
          v-on:submit.prevent="addupdateItem"
          id="empregform"
        >


        <!-- VALIDATION ERROR: on top of form. validation error(422 (Unprocessable Entity)) -->
        <div 
            id="empregtoperrbar"
            class="toperrbar"
            >
            <ul><li v-for="item in formErrors">{{ item[0]}}</li></ul>
        </div>



        <div class="modal-body" style="padding-left:40px; padding-top:20px;padding-bottom:20px;">
 

          <!-- protected $fillable = ['Degree', 'DegreeField', 'Institution', 'DegState', 'Country', 'YearDegreeEarned', 'Notes', 'EmpID']; -->
            <div class="form-group" hidden="true">
              <label for="ID">ID</label>
              <input type="text" class="form-control" name="ID" id="ID"  v-model="formdata.ID" />
            </div>


            <div class="form-group" hidden="true">
              <label for="EmpID">EmpID</label>
              <input type="text" class="form-control" name="EmpID" v-model="formdata.EmpID" />
            </div>


             <div class="form-group" >
              <label
                class="control-label col-sm-4"
               >Registration</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="Registration"  v-model="formdata.Registration">
                   <option v-for="item in lstEmpRegistration" :value="item.ListID">{{ item.Str1 }}</option>
                </select>
                <div style="width:350px; "
                  v-if="formErrors['Registration']"
                  class="error text-danger"
                 >{{ formErrors['Registration'][0]}}
                </div>

              </div>
            </div>


            <div class="form-group" >
              <label
                class="control-label col-sm-4"
               >Registration State</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="RegState"   v-model="formdata.RegState">
                   <option v-for="item in lstState" :value="item.ListID">{{ item.str1 }}</option>
                </select>
              </div>
            </div>



            <div class="form-group">
              <label
                class="control-label col-sm-4"
              >Country</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="Country"   v-model="formdata.Country">
                 
                  <option v-for="item in lstCountry" :value="item.ListID">{{ item.Str1 }}</option>
                </select>
              </div>
            </div>


            <div class="form-group" >
              <label
                class="control-label col-sm-4"
              >Registration No.</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-6">
                <input  type="text"  class="form-control"  name="RegistrationNo"  v-model="formdata.RegistrationNo"
                 />
              </div>
            </div>


            <div class="form-group"  required>
              <label
                class="control-label col-sm-4"
              >Registration Year</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-6">
                <input
                  type="text"  class="form-control"  name="RegYear"  v-model="formdata.RegYear"
                 />
                <div style="width:350px; "
                  v-if="formErrors['RegYear']"
                  class="error text-danger"
                 >{{ formErrors['RegYear'][0]}}
                </div>

              </div>
            </div>


            <!-- note NOW using v-model because date is send from the controller in format(using carbon 'Y-m-d') recognised
            Note no form v-model binding is used since having problem with html5 date -->
            <!-- Note no form v-model binding is used since having problem with html5 date -->
            <!-- to use html5 date we have to convert date format since it cannot read -->
            <!-- (html date has masking which jquery datepicker dont have which is essential for preventing wrong data with server error -->
            <!-- so moment is used in update method to convert date to YYYY-MM-DD which html date can read  -->
            <!-- http://jsfiddle.net/r42jg/303/ -->
            <div class="form-group" >
              <label
                class="control-label col-sm-4"
              >Registration Issue Date</label>
              <div class="col-sm-6">
                <input   type="date" 
                name="RegIssueDate"   
                id="RegIssueDate"  
                class="form-control startdate"  
                placeholder="mm/dd/yyyy" 
                v-model="formdata.RegIssueDate"
                />
 
                  <div style="width:350px; "
                  v-if="formErrors['RegIssueDate']"
                  class="error text-danger"
                 >{{ formErrors['RegIssueDate'][0]}}
                </div>  
 
              </div>
            </div>


            <!-- note NOW using v-model because date is send from the controller in format(using carbon 'Y-m-d') recognised
            Note no form v-model binding is used since having problem with html5 date -->
            <!-- Note no form v-model binding is used since having problem with html5 date -->
            <div class="form-group" >
              <label
                class="control-label col-sm-4"
              >Registration Expiry Date</label>
              <div class="col-sm-6">
                <input   type="date" 
                name="RegExpDate"   
                id="RegExpDate"  
                class="form-control startdate"  
                placeholder="mm/dd/yyyy" 
                v-model="formdata.RegExpDate"
                />
                  
                 <div style="width:350px; "
                  v-if="formErrors['RegExpDate']"
                  class="error text-danger"
                 >{{ formErrors['RegExpDate'][0]}}
                </div>             
              
              </div>
            </div>


            <div class="form-group"  >
              <label
                class="control-label col-sm-4"
              >Notes</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-6">
                <textarea type="text"  class="form-control"  name="Notes" id="Notes" style="height:100px;width:350px; margin-bottom:0px;"  v-model="formdata.Notes"
                    ></textarea>
                  <div style="width:350px; "
                    v-if="formErrors['Notes']"
                    class="error text-danger"
                  >{{ formErrors['Notes'][0]}}
                  </div>

              </div>
            </div>

            <!-- <div class="form-group" style="margin-bottom:10px;"> -->
                    <!-- <div class="modal-footer " style="width: 375px;margin-top: 100px;margin-right: 0px;  margin-bottom: -10px; border-color:#cccccc; border-width: 0"> -->
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 232px;">Close</button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 7px; " id="save">
                        Save changes
                        </button> -->
                    <!-- </div> -->
            <!-- </div> -->

            </div>
             <!-- end modal body -->
        <div class="modal-footer" style="padding-bottom:20px;padding-right:36px">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" style="margin-left: 7px; " id="save"> -->
            <button type="submit" class="btn btn-primary" style="width:100px">Save</button>
            <button @click="modalclosed" type="button" class="btn btn-secondary" style="width:100px;background-color:#e6e6e6;border-color:#c5c5c5;" data-dismiss="modal">Cancel</button>
        </div>  
          
        </form>
        <!-- end form  -->

      </div>
      <!-- content -->
    </div>
    <!-- end div modal dialog -->
  </div>
  <!-- End Edit Modal ********************************************************-->







<!-- <a id="btnAddModal" href="{% url 'create_empdegree' 1 %}" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;" onclick="addEditEmpDegree(0)"><i class="fa fa-plus"></i> Add New</a>   -->
    <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;color:#006fae;" v-on:click="showempregaddmodal"><i class="fa fa-plus" style="color:#006fae;"></i> Add New</a>
    <!-- <table id="empdegreeTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
    <table id="empregistrationTable" class="table table-striped table-bordered" style="width:100%;">
        <thead >
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Registration
                </th>
                <th>
                    State
                </th>
                <th>
                    Country
                </th>
    
                <th>
                    Registration no.
                </th>
                <th>
                    Year
                </th>
                <th>
                    Issue date
                </th>
                <th>
                    Expiry date
                </th>
                <th>
                    Notes
                </th>
                <th hidden="hidden">
                    EmpID
                </th>
                <!-- <th hidden="hidden">
                    EmployeeID
                </th> -->
                <!-- <th hidden="hidden">
                    ID
                </th> -->
                <th style="width:130px;">Action</th>
    
    
            </tr>
        </thead>
    
    </table>

    <input type="text"  id="reghiddenid"  hidden/> <!-- this will store the empid on datatable row click -->
    <!-- <h1 id="reghiddenopendetailpage" @click="openempregdetailpage()" hidden>hiddenopendetailpage</h1>
    <h1 id="reghiddenshoweditmodal" @click="showempregeditmodal()" hidden>hiddenshoweditmodal</h1>
    <h1 id="reghiddendeleteempreg" @click="deleteempreg()" hidden>hiddendeleteempreg</h1> -->

    <!-- hidden p to get emp id employee_detail.html passed from from view 'employee_degree' -->
    <!-- <p id="reghiddenempid" style="display: none">{{empid}}</p> -->

    <!-- this is used for clicking outside of modal which cannot be catched by modal buttons close event. so fired by jquery -->
    <!-- <h1 id="reghiddenmodalonhide" @click="modalonhide()" hidden>hiddenmodalonhide</h1> -->
<!-- <globaldeletemsgchild /> -->

  </div>
</template>


<script>

  // import moment from 'moment';
  // import axios from "axios";

export default {
  name: "empregtabcontent",
  components: {
  },
  data() {
    return {
      empid: 0, // this EmpID of Employee
      id: 0,    // this is ID of degree table
    //   empreg: {},

      lstEmpRegistration: [],
      lstState: [],
      lstCountry: [],

      formErrors: {},
    // formErrorsUpdate: {},

    //GENERAL ERROR: Test if any error other than validation error(422 (Unprocessable Entity))
      // errstatus:false, //test
      // errstatusttext:'', //test   


      formdata: {
        Registration:0, 
        RegState:0,
        Country:0, 
        RegistrationNo:'', 
        RegYear:'', 
        RegIssueDate:'',
        RegExpDate:'', 
        Notes:'', 
        ID:0,
        EmpID:0
      } ,

     empreg:{},

     addmode:true, // to switch between updateitem and additem 

    };
  },

  methods:{

      // this is called from  modal buttons close event
      modalclosed(){
         this.formErrors="";
        //  $("#empregtoperrbar").hide();
        $("#empregtoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition

         this.addmode=true; 
         $("#RegIssueDate").val(''); // have to clear date with JQuery instead of slearing formdata since it is not binded
         $("#RegExpDate").val(''); // have to clear date with JQuery instead of slearing formdata since it is not binded      
      },



      // this is for clicking outside of modal which cannot be catched by modal buttons close event
      modalonhide(){
         this.formErrors="";
        //  $("#empregtoperrbar").hide();  
        $("#empregtoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
         this.addmode=true;
      },



      clearaddform(){

      // ** Should clear formdata since it could be populated with previous edit data
        this.formdata.Registration=0;
        this.formdata.RegState=0;
        this.formdata.Country=0;
        this.formdata.RegistrationNo=''; 
        this.formdata.RegYear=''; 
        this.formdata.RegIssueDate=''; 
        this.formdata.RegExpDate='';
        this.formdata.Notes=''; 
        this.formdata.ID=0;
        this.formdata.EmpID=0;

         this.formErrors="";  
        //  $("#empregtoperrbar").hide();
        $("#empregtoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
        // RegIssueDate & RegExpDate are cleared manually since not binded with v-modal
        //  document.getElementById("RegIssueDate").valueAsDate = null;
        //  document.getElementById("RegExpDate").valueAsDate = null;
        $('input[type=date]')[0].value = 0;
        $('input[type=date]')[1].value = 0;

         this.addmode=true; // must set to true here for extra safety(since modal can hide by clicking outside of modal)

    },

      openempregdetailpage(){

        //this.id = $("#reghiddenid").val();  // this.id now set in mounted under table click
        this.$axios
        // .get("apiempregdetaildata/" + this.id + "").then(response => {
          .get(this.$host+"api/empregistration/view/" + this.id + "").then(response => {
            // this.empreg = response.data[0];
            this.empreg = response.data;

            //Change date format using moment.js 
            if (response.data.RegIssueDate) {
              this.empreg.RegIssueDate = this.$moment(response.data.RegIssueDate).format("MM/DD/YYYY");
            } 
            if (response.data.RegExpDate) {
              this.empreg.RegExpDate = this.$moment(response.data.RegExpDate).format("MM/DD/YYYY");
            } 
            // By default mssql saves '1900-01-01' for empty date. So show blank when date is '1900-01-01'
            if (this.empreg.RegIssueDate === '01/01/1900') {
              this.empreg.RegIssueDate = '';
            }
            if (this.empreg.RegExpDate === '01/01/1900') {
              this.empreg.RegExpDate = '';
            }


        })
        .catch(err => {
            iziToast.error({
              title: 'Error',
              message: 'Error opening detail page',
            });
        });

        $("#empregdetailmodal").modal("show");            

      },

      showempregaddmodal(){
          var s1 = 'admin'//blocked for test// this.$usertype;
          var s2 = "admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
              alert("You don't have permission to run this operation");
            //$("#globalunauthorisedmsg").modal("show");
            return;
          } 

          $('#empregmodal').trigger("reset");
          // $('#empform')[0].reset();
          this.clearaddform();  
          this.formdata.EmpID=this.empid;// set the mastertable empid for the child table degree    
          $("#empregmodal").modal("show");
          // console.log(this.formdata.EmpID);
      },



      showempregeditmodal(){

          var s1 = 'admin'//blocked for test// this.$usertype;
          var s2="admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
             alert("You don't have permission to run this operation");
            //$("#globalunauthorisedmsg").modal("show");
            return;
          } 

         //alert("Reg Edit form: "+ this.id);
          this.addmode=false

          // this.id = $("#reghiddenid").val();  // this.id now set in mounted under table click

        this.$axios
            .get(this.$host+"api/empregistration/edit/" + this.id + "").then(response => {
            // this.formdata = response.data[0];
            this.formdata = response.data;

           //Change date format using moment.js to make html datepicker work
           if (!response.data.RegIssueDate=="") {
            let hiredate = this.$moment(response.data.RegIssueDate).format("YYYY-MM-DD");
            this.formdata.RegIssueDate = hiredate;
            } 
           if (!response.data.RegExpDate=="") {
            let hiredate2 = this.$moment(response.data.RegExpDate).format("YYYY-MM-DD");
            this.formdata.RegExpDate = hiredate2;
            } 

            // By default mssql saves '1900-01-01' for empty date. So show blank when date is '1900-01-01'
            if (response.data.RegIssueDate=='1900-01-01') {
              this.formdata.RegIssueDate='';
            }
            if (response.data.RegExpDate=='1900-01-01') {
              this.formdata.RegExpDate='';
            }

            // have to use this if date is present
            // to use html5 date we have to convert date format since it cannot read
            // (html date has masking which jquery datepicker dont have which is essential for preventing wrong data with server error
            // so moment is used to convert date to YYYY-MM-DD which html date can read 
            //http://jsfiddle.net/r42jg/303/


            // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'Y-m-d')
            // // so that it is recognised by html datepicker which is yyyy-MM-dd
            // if (this.formdata.RegIssueDate!==null) {
            //     let userDate = this.formdata.RegIssueDate;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY.MM.DD").format("YYYY-MM-DD");
            //     $("#RegIssueDate").val(date_string);
            // }
            // if (this.formdata.RegExpDate!==null) {
            //     let userDate = this.formdata.RegExpDate;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY.MM.DD").format("YYYY-MM-DD");
            //     $("#RegExpDate").val(date_string);
            // }


            //NOT REQUIRED if nullable is used in validation and database******************************************** */
            // // to show '' (instead of 01/01/1900) in html datepicker box when data is default date of '1900-01-01 00:00:00'
            // // since html5 datepicker always put '1900-01-01 00:00:00' instead of null
            // // TODO localhost mysql is not accepting 1901 so 1902 is used as blank date. But deployment server accepts 1900-01-01 00:00:00
            // if (this.formdata.RegIssueDate=='1900-01-01 00:00:00') {
            //     $("#RegIssueDate").val('');
            // }
            // if (this.formdata.RegExpDate=='1900-01-01 00:00:00') {
            //     $("#RegExpDate").val('');
            // }
            //********************************************************************************************************** */

            })
            .catch(err => {
              iziToast.error({
                title: 'Error',
                message: 'Error opening edit form',
              });
            });

            $("#empregmodal").modal("show");
          
      },



     addupdateItem(){
  
        var s1='admin' //Blocked for test //this.$usertype;
        var s2="admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
             alert("You don't have permission to run this operation");
            //$("#globalunauthorisedmsg").modal("show");
            return;
        }        

        let apiurl=''

        if (this.addmode) {
          // apiurl="apiempregadddata/";
          apiurl=this.$host+"api/empregistration/";
        } else {
          // apiurl="/api/apiemregupdatedata/";
          // apiurl="apiupdatereg/";
          apiurl=this.$host+"api/empregistration/update";
          // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'Y-m-d')
          // // so that it is recognised by html datepicker which is yyyy-MM-dd
          // // and thus we can use model binding for date
          // // have to use this if date field is present
          // this.formdata.RegIssueDate=$("#RegIssueDate").val();// manually set value since RegIssueDate is not binded
          // this.formdata.RegExpDate=$("#RegExpDate").val();// manually set value since RegExpDate is not binded
        }


            //NOT REQUIRED if nullable is used in validation and database******************************************** */

            // // have to use this if date field is present
            // // have to use " 00:00:00" with date else will not update
            // var str=$("#RegIssueDate").val()+" 00:00:00"
            // this.formdata.RegIssueDate=str;//"2019-08-04 13:17:29";

            // var str1=$("#RegExpDate").val()+" 00:00:00"
            // this.formdata.RegExpDate=str1;//"2019-08-04 13:17:29";

            // // this.$http.post("/api/apiempupdatedata/", this.formData).then(

            // //added for Mysql database it is not taking 1900-01-01
            // // localhost mysql is not accepting 1901 so 1902 is used as blank date. But deployment server accepts 1900-01-01 00:00:00
            // if ($("#RegIssueDate").val()==='') {
            //   console.log("going");
            //   this.formdata.RegIssueDate="1900-01-01 00:00:00";//"2019-08-04 13:17:29";
            //   // this.formdata.RegIssueDate="2018-08-04 13:17:29";//"2019-08-04 13:17:29";
            // }
            // if ($("#RegExpDate").val()==='') {
            //   this.formdata.RegExpDate="1900-01-01 00:00:00";//"2019-08-04 13:17:29";
            //   // this.formdata.RegExpDate="2019-08-04 13:17:29";
            // }
            //********************************************************************************************************** */


            //  Foreign key is used in main table for List items col which has to set to null(instead of 0) 
            //  ONDELETE(when a list item row id deleted) as per mysql. 
            //  NOTE: All NULL values are automatically send to the controller as string '' which stores NULL in db 
            //  if default value for the field is NULL. So no need to convert the NULL values here. 
            //  Conversion is needed if FormData is used to send data to controller like Employee.  


            this.$axios.post(apiurl, this.formdata).then(response => {

                  $("#empregmodal").modal("hide");

                  let msg=""
                  if (this.addmode==true) {
                    msg="Added Registration successfully"
                  } else {
                    msg="Registration has been edited successfully"
                  }
                  iziToast.success({
                    title: "Successful",
                    position:"topRight",
                    message: msg
                  });

                  $('#empregistrationTable').DataTable().ajax.reload(); // refresh parent table
                  this.addmode=true; //now done in onmodalhide(), still used here

              })
              .catch((err) => {

                   console.log(err)

                  //axios Network Error doesnt have err.response.status, so used seperate condition
                   if (err.message==="Network Error") {
                        $("#empregmodal").modal("hide");
                        alert("Network Error")
                        // toastr.error("Could not Save. "+ err.message, "Alert", {
                        //     timeOut: 5000 //3000
                        // });
                        return;
                   }                    
                   if (err.response.status===422) { 
                        this.formErrors = err.response.data; // validation error(422 (Unprocessable Entity))
                        var totalerr=Object.keys(this.formErrors).length //count the number of properties(errors) in a JavaScript object
                        var height=30+(totalerr*20);
                        // $("#empregtoperrbar").css("height", height+'px');
                        // $('#empregtoperrbar').slideDown();

                        // Now using css transition instead of jquery to slide uo and down added in master.blade
                        // $("#empregtoperrbar").css("transition", 'height 300ms'); // css transition instead of jquery to slide uo and down
                        $("#empregtoperrbar").css("height", height+'px');                       
                        // $('#empregtoperrbar').show();
                        return;
                   } 
                    // GENERAL ERROR: Test  if any error other than validation error(422 (Unprocessable Entity) or Network)
                    $("#empregmodal").modal("hide");
                        alert("Error: Could not Save")
                        // toastr.error("Could not Save. "+ err.response.statusText + " : "+ err.message, "Alert", {
                        // timeOut: 5000 //3000
                    // });  



              });  // end catch


     },

      empregconfirmdelete(){

          var s1='admin' //Blocked for est//this.$usertype;
          var s2="admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
             alert("You don't have permission to run this operation");
            //$("#globalunauthorisedmsg").modal("show");
            return;
          } 

          // // to show degree and employeeid in delete msg since empdegree is not populated yet
          // this.$axios
          //   .delete(this.$host+"api/empregistration/" + this.id + "").then(response => {
          //       // this.empreg = response.data[0];
          //      alert("Deleted1")
          //      this.empreg = response.data;
          // })
          //   .catch(err => {
          //       console.log(err);
          // });         

          $("#empregconfirmdelete").modal("show");
      },


     deleteempreg(){

          // var s1='admin'//blocked for test// this.$usertype;
          // var s2="admin";
          // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
          //   // alert("You don't have permission to run this operation");
          //   $("#globalunauthorisedmsg").modal("show");
          //   return;
          // } 
      
          // var confirmdelete = confirm("Are you you want to delete the item?");
          // if (confirmdelete ==false) {
          //   return;
          // }


          // this.id = $("#reghiddenid").val();   // this.id now set in mounted under table click
          this.$axios
            // .post("/api/apiempregdeletedata/" + this.id + "")
            .delete(this.$host+"api/empregistration/" + this.id + "").then(response => {
              
              // this.formdata = response.data[0];
              iziToast.success({
                title: "Successful",
                position:"topRight",
                message: "Deleted item successfully"
              });
                   
              $('#empregistrationTable').DataTable().ajax.reload(); // refresh parent table

            })
       
            .catch(err => {

              iziToast.error({
                  title: 'Error',
                  message: 'Error deleting record',
              });


            });// end catch

        }
  },

  mounted() {

      // Datatable action col click events now from mounted instead of hidden button click
      // call vue data inside jquery
      // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component

      var self = this;
      
      $("#empregistrationTable").on("click", "#empregview", function(){
          self.id=$("#reghiddenid").val();
          self.openempregdetailpage();
      });
      $("#empregistrationTable").on("click", "#empregedit", function(){
          self.id=$("#reghiddenid").val();
          self.showempregeditmodal();
      });
      $("#empregistrationTable").on("click", "#empregdelete", function(){
          self.id=$("#reghiddenid").val();
          // self.deleteempreg();
          self.empregconfirmdelete();
          // $("#globaldeletemsgchild").modal("show");
      });

      
      // if clicked outside of bootstrap modal it hides and cannot catch this event with vue
      // so indiretcly catching this event by vue event "modalonhide" which will fire with a hidden btn click
      // called from this jquery modal hide function  
      $('#empregmodal').on('hidden.bs.modal', function () {
        //  $('#reghiddenmodalonhide').click();
        self.modalonhide();

      });  



    var token=this.$apitoken; // for api protection api_token is saved globally in app.js and use here
    var baseurldt=this.$baseURLdt;

        // get the id from query parameter to store it in data empid, it is then used in <p>hiddenempid</p>
        // then get the value from the hiddenempid using "var eid=$('#hiddenempid').html();" to use it in datatable parameter
        var eid=this.$route.query.this;
        this.empid=eid;

        $(document).ready(function () {

            // var eid=$('#reghiddenempid').html();
            var eid=self.empid;
           
    
        // delay loading of tab data which are not default
        setTimeout(() => {

                //NO SERVERSIDE PROCESSING
               var table = $('#empregistrationTable').DataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bInfo": true,
                    "bAutoWidth": true,
                    "orderable": false,
                    "searchable": false,
                    // "width": "100px",
                    "pageLength": 10,
                    "order": [0, "asc"],                    
                    // "serverSide": true,                    
                    "processing": true,
                    language: {
                    // processing: "<img src='/media/icons/ajax-loader.gif'>"
                    processing: "<img src='images/ajax-loader.gif'>",
                    //  "loadingRecords": ""
                    },    
                    
 
                    "ajax": {
                        // "url": "/api/apiempregdata/",// passing empid through POST request to api
                        // url: baseurldt+"apiempregdata", 
                        url: self.$host+"api/empregistration/"+eid, 
                        headers: {
                          // for api protection api_token is saved globally in app.js and use here
                          'Authorization' : token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
                        },
                        "type": "get",
                        "datatype": "json",
                        "dataSrc": '', // dont use for server side processing

                        // passing empid through GET request to api    
                        "data": {
                            "EmpID": eid
                        },
        
                    },

                    "columns": [
                        { "data": "ID", "visible": false },
                        {
                        "data": "disRegistration", 
                          // "render": function (data, type, row) {
                          // return (
                          //     "<a onclick=$('#reghiddenid').val("+row.ID +"); id='empregview' style='cursor:pointer'>"+ data +"</a>"
                          //     );
                          //    }
                        }, 
                        { "data": "disRegState","defaultContent": "" },
                        { "data": "disCountry","defaultContent": "" },
                        { "data": "RegistrationNo" },
                        { "data": "RegYear" },
                        // { "data": "RegIssueDate" },
                        // { "data": "RegExpDate" },

                        // https://datatables.net/plug-ins/dataRender/datetime
                        // https://datatables.net/forums/discussion/25196/render-date-and-retain-order-functionality-ajax-object
                        {
                            "data": "RegIssueDate", "render": function (data, type, row) {
                                if (data == null) { // to replace "Invalid Date" with "", happens when date field is NULL
                                    return "";
                                }
                                if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                                    return "";
                                }
                                	
                                else {
                                    return (self.$moment(data).format("MM/DD/YYYY"));
                                }
                            }
                        },
        
                        {
                            "data": "RegExpDate", "render": function (data, type, row) {
                                if (data == null) { // to replace "Invalid Date" with "", happens when date field is NULL
                                    return "";
                                }
                                if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                                    return "";
                                }
                                else {
                                    return (self.$moment(data).format("MM/DD/YYYY"));
                                }
                            }
                        },
                        //**turned of some fields for following Error
                        // Most likely causes:
                        // Request filtering is configured on the Web server to deny the request because the query string is too long.
                        // { "data": "Notes" },
                        { "data": "EmpID", "visible": false },
                        // { "data": "Emp_Main.EmployeeID", "visible": false },
                        //{ "data": "ID", "visible": false },
                        {
                            "data": "ID", "render": function (data, type, row) {
                                // Condition is used to show or hide buttons according to role
                                //https://stackoverflow.com/questions/23356505/how-to-get-mvc-c-sharp-user-role-in-jquery
        
                                // var userRole = true;
                                // if (userRole) {
                                //     return "<a  style='cursor:Pointer'  onclick='viewEmpRegistration(" + data + ");'>View</a> | <a  style='cursor:Pointer'  onclick='editEmpRegistration(" + data + ");'>Edit</a> | <a  style='cursor:Pointer'  onclick='deleteEmpRegistration(" + data + ");'>Delete</a>"
                                // }
                                // else {
                                //     return "<a  style='cursor:Pointer'  onclick='viewEmpRegistration(" + data + ");'>View</a> | <a  style='cursor:Pointer'  onclick='editEmpRegistration(" + data + ");'>Edit</a>"
                                // }
                                
                                //return "<a  href='/kseprojects/empregistration_detail/" + data + "'>View</a> | <a  href='/kseprojects/update_empregistration/" + data + "/'>Edit</a>"
                                return    "<a onclick=$('#reghiddenid').val("+row.ID +");  id='empregview' style='cursor:pointer'>View</a> | <a onclick=$('#reghiddenid').val("+row.ID +");  id='empregedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#reghiddenid').val("+row.ID +");  id='empregdelete' style='cursor:pointer'>Delete</a>"

                            },
                        } // end col ID
        
       
                    ] // end columns
        
                });//end var table

          }, 2000) 

    }) // End document ready


    setTimeout(() => {
      // set time is used to load combo after parent table is loaded to make table load fast

      // axios.get("/api/apilstJobTitle")
      //         .then((response) => {
      //             this.lstJobTitle = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });

      // this.$http
      //   .get("/api/apilstRegistration")
      //   .then(function(response) {
      //     this.lstEmpRegistration = response.body;
      //   });

      // axios.get("apilstRegistration").then((response) => {
      //             this.lstEmpRegistration = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });

      // axios.get("apilstState").then((response) => {
      //             this.lstState = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });
      // axios.get("apilstCoutry").then((response) => {
      //             this.lstCountry = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });


      // now receiving all combo in one request under a group
      // ***********************************************************************

            // this.$axios.get("apiempregcombogroup").then((response) => {
            //       this.lstEmpRegistration = response.data.List_EmpRegistration;
            //       this.lstState = response.data.List_State;
            //       this.lstCountry = response.data.List_Country;

            //   }).catch((err) => {
            //       console.log(err)
            //       console.log("going");
            //   }); 

          this.$axios.get(this.$host + "api/empcombo/empregistration").then((response) => {
            this.lstEmpRegistration = response.data[0].empregistration;
            this.lstState = response.data[1].state;
            this.lstCountry = response.data[2].country;
          }); 




    }, 2000); // This promise will be resolved in 2000 milli-seconds


  }, // end mounted

}; // end export default


</script>




<style>



/* search combo styles************************************ */
#empregform .form-group{
  margin-bottom: 5px;
}

#empregform select[type="select"] {
   height: 30px;
   width:350px;
   border-radius: 0px;
}
#empregform label {
   padding-right:0px;
}

#empregform input[type="text"] {
   height: 30px;
   width:350px;
   border-radius: 0px;
}
#empregform input[type="date"] {
   height: 30px;
   width:350px;
   border-radius: 0px;
}
/*align labels left*/
#empregmodal .control-label{
    text-align: left;
    margin-bottom: 0px;
    font-size: 13px;
    color:black;

    /* style="margin-right:0px;padding-left:30px;text-align:left;font-size: 13px; color:black;" */
}
/* END search combo styles************************************ */


/* not working in common css so put in one of the component */
/* class for processing img, to remove the box around the image */
.dataTables_processing{
  position: absolute;
  border: none;
  background: transparent;
}



</style>
