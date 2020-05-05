<template>

  <div>

    <!-- Start Confirm Delete Modal ********************************************* -->
    <div id="empdegreeconfirmdelete" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="padding-bottom:5px;background-color:#f1f1f1;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Delete Confirmation</h3>
          </div>
          <div class="modal-body" style="padding:30px;">
            Are you sure you want to delete the selected degree <span style="font-size:16px;"><b>'{{empdegree.Degree}}'
              </b></span> <br>
            from employee degree of employee <span style="font-size:16px;"><b> '{{empdegree.EmpID}}' </b> </span>?
          </div>
          <div class="modal-footer">
            <button @click="deleteempdegree()" type="button" data-dismiss="modal" class="btn btn-danger"
              id="delete">Delete</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Start Detail Modal ********************************************* -->
    <div class="modal fade" id="empdegreedetailmodal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content " style="width:550px">



          <div class="modal-header"
            style="background-color: #f1f1f1; border-radius: 5px 5px 0 0;  border-bottom: 1px solid lightgrey;  height: 52px; ">
            <button @click="modalclosed" type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Employee Degree Detail</h4>
          </div>

          <div class="modal-body" id="details" style="padding:30px;padding-top:20px; padding-bottom:0px;">

            <dl class="dl-horizontal" style="margin-bottom:10px;">
              <!-- <dt>EmployeeID</dt>

            <dd id="ddEmployeeID"> -->
              <!-- https://stackoverflow.com/questions/6584235/django-want-to-display-an-empty-field-as-blank-rather-displaying-none -->
              <!-- {% if not emp.EmployeeID == None %}
              {{emp.EmployeeID}}
              {%endif%}-->
              <!-- {{proteam.EmployeeID}} -->
              <!-- {{emp.EmployeeID}} -->
              <!-- </dd> -->

              <dt>Degree</dt>
              <dd id="ddDegree">{{empdegree.disDegree}}</dd>
              <dt>Degree Field</dt>
              <dd id="ddDegreeField">{{empdegree.DegreeField}}</dd>
              <dt>Institution</dt>
              <dd id="ddDegreeField">{{empdegree.Institution}}</dd>
              <dt>Degree State</dt>
              <dd id="ddDegState">{{empdegree.disState}}</dd>
              <dt>Country</dt>
              <dd id="ddCountry">{{empdegree.disCountry}}</dd>
              <dt>Year Degree Earned</dt>
              <dd id="ddYearDegreeEarned">{{empdegree.YearDegreeEarned}}</dd>
              <dt>Created at</dt>
              <dd id="ddcreatedat">{{empdegree.created_at}}</dd>
              <dt>Updated at</dt>
              <dd id="ddupdatedat">{{empdegree.updated_at}}</dd>
              <dt>Notes</dt>
              <dd id="ddNotes">{{empdegree.Notes}}</dd>

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
    <div class="modal fade" id="empdegreemodal" role="dialog">
      <div class="modal-dialog" style="width:550px">
        <!-- Modal content-->
        <div class="modal-content">


          <div v-if="loading2" class="loading-container"
            style="width:100%;height:100%;background-color: transparent;opacity:1;position: absolute;z-index: 2;">
            <img class="imgloading" style="display: block;margin-top: 120px; margin-left: 200px;margin-right: auto;"
              src="/img/loading4.gif" />
          </div>






          <div class="modal-header"
            style="background-color: #f1f1f1; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 52px;">
            <button @click="modalclosed" type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title">Edit Degree</h4> -->
            <h4 class="modal-title" v-if="addmode">Add Degree</h4>
            <h4 class="modal-title" v-else>Edit Degree</h4>
          </div>

          <form class="form-horizontal" enctype="multipart/form-data" v-on:submit.prevent="addupdateItem"
            id="empdegreeform">


            <!-- VALIDATION ERROR: on top of form. validation error(422 (Unprocessable Entity)) -->
            <!-- <div 
            id="empdegreetoperrbar"
            class="toperrbar"
            >
            <ul><li v-for="item in formErrors">{{ item[0]}}</li></ul>
            </div> -->


            <!-- ERROR TOP BAR -->
            <div id="empdegreetoperrbar"
              style="height:0px; color: #721c24;background-color: #f8d7da;border-color: #f5c6cb; transition: height .3s;">
              <ul style="padding-left:55px;">
                <li style="padding-left:5px;" v-for="err in formErrors">{{err.msg}}</li>
              </ul>
            </div>
            <!-- END ERROR TOP BAR -->



            <!-- form in place of modal body div -->
            <!-- <form method="post" class="modal-body" enctype="multipart/form-data" v-on:submit.prevent="updateItem"> -->
            <div class="modal-body" style="padding-left:40px; padding-top:20px;padding-bottom:20px;">

              <!-- protected $fillable = ['Degree', 'DegreeField', 'Institution', 'DegState', 'Country', 'YearDegreeEarned', 'Notes', 'EmpID']; -->
              <div class="form-group" hidden="true">
                <label for="ID">ID</label>
                <input type="text" class="form-control" name="ID" v-model="formdata.ID" />
              </div>


              <div class="form-group" hidden="true">
                <label for="EmpID">EmpID</label>
                <input type="text" class="form-control" name="EmpID" v-model="formdata.EmpID" />
              </div>


              <div class="form-group">
                <label class="control-label col-sm-3 degreelabel">Degree</label>
                <div class="col-sm-7">
                  <select type="select" class="form-control" name="Degree" v-model="formdata.Degree">
                    <option v-for="item in lstEmpDegree" :value="item.ListID">{{ item.str1 }}</option>
                  </select>
                  <div style="width:340px; " v-if="formErrors['Degree']" class="error text-danger">
                    {{ formErrors['Degree'][0]}}
                  </div>
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-sm-3">Degree Field</label>
                <!-- v-model="formdata.DegreeField" to bind to data  -->
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="DegreeField" v-model="formdata.DegreeField" />
                  <div style="width:340px;" v-if="formErrors['DegreeField']" class="error text-danger">
                    {{ formErrors['DegreeField'][0]}}
                  </div>
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-sm-3">Institution</label>
                <!-- v-model="formdata.DegreeField" to bind to data  -->
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="Institution" v-model="formdata.Institution" />
                </div>
              </div>



              <div class="form-group">
                <label class="control-label col-sm-3">Degree State</label>
                <div class="col-sm-7">
                  <select type="select" class="form-control" name="DegState" v-model="formdata.DegState">
                    <option v-for="item in lstState" :value="item.ListID">{{ item.str1 }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Country</label>
                <div class="col-sm-7">
                  <select type="select" class="form-control" name="Country" v-model="formdata.Country">
                    <option v-for="item in lstCountry" :value="item.ListID">{{ item.Str1 }}</option>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-sm-3">Degree Year </label>
                <!-- v-model="formdata.DegreeField" to bind to data  -->
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="YearDegreeEarned" v-model="formdata.YearDegreeEarned" />
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Notes</label>
                <!-- v-model="formdata.DegreeField" to bind to data  -->
                <div class="col-sm-7">
                  <textarea type="text" class="form-control" name="Notes"
                    style="height:100px;width:340px; margin-bottom:0px;" v-model="formdata.Notes"></textarea>
                  <div style="width:340px; " v-if="formErrors['Notes']" class="error text-danger">
                    {{ formErrors['Notes'][0]}}
                  </div>
                </div>


              </div>


              <!-- <div class="form-group" > -->
              <!-- <div class="modal-footer " style="width: 375px;margin-top: 100px;margin-right: 0px;  margin-bottom: -10px; border-color:#cccccc; border-width: 0"> -->
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 232px;">Close</button>
            <button type="submit" class="btn btn-primary" style="margin-left: 7px; " id="save">
              Save changes
            </button> -->
              <!-- </div> -->
              <!-- </div> -->


            </div><!-- end modal-body -->
            


            <div class="modal-footer" style="padding-bottom:20px;padding-right:36px;">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" style="margin-left: 7px; " id="save"> -->
              <button type="submit" class="btn btn-primary" style="width:100px">Save </button>
              <button @click="modalclosed" type="button" class="btn btn-secondary"
                style="width:100px;background-color:#e6e6e6;border-color:#c5c5c5;" data-dismiss="modal">Cancel</button>
            </div>


          </form>
          <!-- form in place of modal body div -->

        </div>
        <!-- content -->

      </div>
      <!-- end div modal dialog -->
 
    </div>
    <!-- End Edit Modal ********************************************************-->









    <!-- <a id="btnAddModal" href='/kseprojects/create_empdegree/{{empid}}/' style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;" onclick="addEditEmpDegree(0)"><i class="fa fa-plus"></i> Add New</a> -->
    <!-- <a id="btnAddModal" href='/kseprojects/create_empdegree/{{empid}}/' style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;" onclick="addEditEmpDegree(0)"><i class="fa fa-plus"></i> Add New</a> -->



    <!-- <a id="btnAddModal" href="{% url 'create_empdegree' 1 %}" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;" onclick="addEditEmpDegree(0)"><i class="fa fa-plus"></i> Add New</a>   -->
    <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;color:#006fae;"
      v-on:click="showempdegreeaddmodal"><i class="fa fa-plus" style="color:#006fae"></i> Add New</a>
    <!-- <table id="empdegreeTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
    <table id="empdegreeTable" class="table table-striped table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>
            ID
          </th>
          <th>
            Degree
          </th>
          <th>
            Degree field
          </th>
          <th>
            Institution
          </th>
          <th>
            Year
          </th>
          <th>
            State
          </th>
          <th>
            Country
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
          <th style="width:130px !important;">Action</th>


        </tr>
      </thead>

    </table>

    <input type="text" id="degreehiddenid" hidden /> <!-- this will store the empid on datatable row click -->
    <!-- <h1 id="degreehiddenopendetailpage" @click="openempdegreedetailpage()" hidden>hiddenopendetailpage</h1>
    <h1 id="degreehiddenshoweditmodal" @click="showempdegreeeditmodal()" hidden>hiddenshoweditmodal</h1>
    <h1 id="degreehiddendeleteempdegree" @click="deleteempdegree()" hidden>hiddendeleteempdegree</h1> -->

    <!-- hidden p to get emp id employee_detail.html passed from from view 'employee_degree' -->
    <!-- <p id="degreehiddenempid" style="display: none">{{empid}}</p> -->

    <!-- this is used for clicking outside of modal which cannot be catched by modal buttons close event. so fired by jquery -->
    <!-- <h1 id="degreehiddenmodalonhide" @click="modalonhide()" hidden>hiddenmodalonhide</h1> -->
    <!-- <globaldeletemsgchild /> -->
  </div>
</template>


<script>

  // import moment from 'moment';
  // import axios from "axios";

  export default {
    name: "empdegreetabcontent",
    components: {

    },
    data() {
      return {
        empid: 0, // this EmpID of Employee
        id: 0,    // this is ID of degree table
        lstEmpDegree: [],
        lstState: [],
        lstCountry: [],
        // offset: 4,
        formErrors: {},
        // formErrorsUpdate: {},
        //GENERAL ERROR: Test if any error other than validation error(422 (Unprocessable Entity))
        // errstatus:false, //test
        // errstatusttext:'', //test   
        formdata: {
          Degree: 0,
          DegreeField: '',
          Institution: '',
          DegState: 0,
          Country: 0,
          YearDegreeEarned: '',
          Notes: '',
          ID: 0,
          EmpID: 0
        },
        empdegree: {},
        addmode: true, // to switch between updateitem and additem   
        loading2:false
      };
    },

    methods: {

      modalclosed() {
        this.formErrors = "";
        // this.errstatus=false;
        // this.errstatusttext='';   
        // $("#empdegreetoperrbar").hide();   
        $("#empdegreetoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
        this.addmode = true;
      },

      // this is for clicking outside of modal which cannot be catched by modal buttons close event
      modalonhide() {
        this.formErrors = "";
        //  $("#empdegreetoperrbar").hide();  
        $("#empdegreetoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
        this.addmode = true;
      },


      clearaddform() {
        // ** Should clear formdata since it could be populated with previous edit data
        this.formdata.Degree = 0;
        this.formdata.DegreeField = '';
        this.formdata.Institution = '';
        this.formdata.DegState = 0;
        this.formdata.Country = 0;
        this.formdata.YearDegreeEarned = '';
        this.formdata.Notes = '';
        this.formdata.ID = 0;
        this.formdata.EmpID = 0;
        // this.errstatus=false;
        // this.errstatusttext=''; 
        this.formErrors = "";
        // $("#empdegreetoperrbar").hide();
        $("#empdegreetoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
        this.addmode = true; // must set to true here for extra safety(since modal can hide by clicking outside of modal)
      },


      openempdegreedetailpage() {
        // this.id = $("#degreehiddenid").val();  // this.id now set in mounted under table click

        this.$axios
          .get(this.$host + "api/empdegree/view/" + this.id + "").then(response => {
            // this.empdegree = response.data[0];
            this.empdegree = response.data;
            console.log(response.data);

            // to show date in format MM/DD/YYYY
            if (this.empdegree.created_at != null) {
              let userDate = this.empdegree.created_at;//'1999-02-13 00:00:00';
              var date_string = this.$moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
              this.empdegree.created_at = date_string;
            }
            if (this.empdegree.updated_at != null) {
              let userDate = this.empdegree.updated_at;//'1999-02-13 00:00:00';
              var date_string = this.$moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
              this.empdegree.updated_at = date_string;
            }

          })
          .catch(err => {
            iziToast.error({
              title: 'Error',
              message: 'Error opening form',
            });
          });

        $("#empdegreedetailmodal").modal("show");

      },




      showempdegreeaddmodal() {

        var s1 = 'admin'//blocked for test// this.$usertype;
        var s2 = "admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
           alert("You don't have permission to run this operation");
          //$("#globalunauthorisedmsg").modal("show");
          return;
        }

        $('#empdegreemodal').trigger("reset");
        // $('#empform')[0].reset();
        this.clearaddform();
        this.formdata.EmpID = this.empid;// set the mastertable empid for the child table degree  for adding new record   
        $("#empdegreemodal").modal("show");
        // console.log(this.formdata.EmpID);
      },


      showempdegreeeditmodal() {

        this.loading2=true
        var s1 = "admin";//blocked for test// this.$usertype;
        var s2 = "admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
           alert("You don't have permission to run this operation");
          //$("#globalunauthorisedmsg").modal("show");
          return;
        }

        this.addmode = false
        // this.id = $("#degreehiddenid").val();  // this.id now set in mounted under table click

        this.$axios
          .get(this.$host + "api/empdegree/edit/" + this.id + "").then(response => {
            this.formdata = response.data;

            //// have to use this if date is present
            // // to use html5 date we have to convert date format since it cannot read
            // // (html date has masking which jquery datepicker dont have which is essential for preventing wrong data with server error
            // // so moment is used to convert date to YYYY-MM-DD which html date can read 
            // //http://jsfiddle.net/r42jg/303/
            // if (this.formdata.HireDate!=null) {

            //   let userDate = this.formdata.HireDate;//'1999-02-13 00:00:00';
            // var date_string = moment(userDate, "YYYY.MM.DD").format("YYYY-MM-DD");
            // $("#HireDate").val(date_string);
            // }

            this.loading2=false
          })
          .catch(err => {
            iziToast.error({
              title: 'Error',
              message: 'Error opening form',
            });
            this.loading2=false
          });

        $("#empdegreemodal").modal("show");

      },





      addupdateItem() {

        var s1 = 'admin'//this.$usertype; //blocked for test
        var s2 = "admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
           alert("You don't have permission to run this operation");
          //$("#globalunauthorisedmsg").modal("show");
          return;
        }

        let apiurl = ''

        if (this.addmode) {
          apiurl = this.$host + "api/empdegree";
        } else {
          apiurl = this.$host + "api/empdegree/update";

          // have to use this if date field is present
          // this.formdata.HireDate=$("#datepicker").val();
        }

        // have to use this if date field is present
        // // have to use " 00:00:00" with date else will not update
        // var str=$("#HireDate").val()+" 00:00:00"
        // this.formdata.HireDate=str;//"2019-08-04 13:17:29";

        //  Foreign key is used in main table for List items col which has to set to null(instead of 0) 
        //  ONDELETE(when a list item row id deleted) as per mysql. 
        //  NOTE: All NULL values are automatically send to the controller as string '' which stores NULL in db 
        //  if default value for the field is NULL. So no need to convert the NULL values here. 
        //  Conversion is needed if FormData is used to send data to controller like Employee.  



        // NOW USING AXIOS   
        this.$axios.post(apiurl, this.formdata).then(response => {
          // axios.post(apiurl, formData).then((response) => {// if response data is needed before catch

          $("#empdegreemodal").modal("hide");

          let msg = ""
          if (this.addmode == true) {
            msg = "Added Degree successfully"
          } else {
            msg = "Degree has been edited successfully"
          }
          iziToast.success({
            title: "Successful",
            position: "topRight",
            message: msg
          });

          // this.formErrors=""; now done in onmodalhide() // clear form error else will appear on the form
          $('#empdegreeTable').DataTable().ajax.reload(); // refresh parent table
          this.addmode = true; //now done in onmodalhide(), still used here



        }) // End then
          .catch((err) => {

            if (err.response.status === 422 || err.response.status === 400) {
              this.formErrors = err.response.data.errors;
              this.isFormError = true;
              // this.loading2 = false;
              var arr = Object.keys(this.formErrors);
              var height = arr.length * 32;
              $("#empdegreetoperrbar").css("height", height + "px");

            } else {
              this.formErrors = err.message + ". Please check network connection.";
              $("#empdegreetoperrbar").css({ "height": 60 + "px", "padding": 10 + "px" });
            }



            // console.log(err)
            // //axios Network Error doesnt have err.response.status, so used seperate condition
            //  if (err.message==="Network Error") {
            //       alert("Network Error")
            //       // $("#empdegreemodal").modal("hide");
            //       // toastr.error("Could not Save. "+ err.message, "Alert", {
            //       //     timeOut: 5000 //3000
            //       // });
            //       return;
            // }                    

            //  if (err.response.status===422) { 
            //       this.formErrors = err.response.data; // validation error(422 (Unprocessable Entity))
            //       var totalerr=Object.keys(this.formErrors).length //count the number of properties(errors) in a JavaScript object
            //       var height=30+(totalerr*20);
            //       // $("#empdegreetoperrbar").css("height", height+'px');
            //       // $('#empdegreetoperrbar').slideDown();

            //       // Now using css transition instead of jquery to slide uo and down added in master.blade
            //       // $("#empdegreetoperrbar").css("transition", 'height 300ms'); // css transition instead of jquery to slide uo and down
            //       $("#empdegreetoperrbar").css("height", height+'px');                       
            //       // $('#empdegreetoperrbar').show();
            //       return;
            // } 

            //   // GENERAL ERROR: Test  if any error other than validation error(422 (Unprocessable Entity) or Network)
            //   $("#empdegreemodal").modal("hide");
            //       toastr.error("Could not Save. "+ err.response.statusText + " : "+ err.message, "Alert", {
            //       timeOut: 5000 //3000
            //   });  

          });  // end catch
      },

      empdegreeconfirmdelete() {

        var s1 = 'admin'//blocked for test// this.$usertype;
        var s2 = "admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
          alert("You don't have permission to run this operation");
           //$("#globalunauthorisedmsg").modal("show");
          return;
        }

        // // to show degree and employeeid in delete msg since empdegree is not populated yet
        // this.$axios
        //   // .get("apiempdegreedetaildata/" + this.id + "").then(response => {
        //     .delete(this.$host+"api/empdegree/" + this.id + "").then(response => {
        //       // this.empdegree = response.data[0];
        //       this.empdegree = response.data;
        // })
        //   .catch(err => {
        //       console.log(err);
        // });         

        $("#empdegreeconfirmdelete").modal("show");
      },



      deleteempdegree() {

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
        // this.id = $("#degreehiddenid").val();  // this.id now set in mounted under table click

        this.$axios
          .delete(this.$host + "api/empdegree/" + this.id + "").then(response => {
            iziToast.success({
              title: "Successful",
              position: "topRight",
              message: "Deleted item successfully"
            });
            $('#empdegreeTable').DataTable().ajax.reload(); // refresh parent table

          })  // end then
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
      // call vue data inside jquery,no need for hidden element click for indirect call
      // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component

      var self = this;

      $("#empdegreeTable").on("click", "#empdegreeview", function () {
        self.id = $("#degreehiddenid").val();
        self.openempdegreedetailpage();
      });
      $("#empdegreeTable").on("click", "#empdegreeedit", function () {
        self.id = $("#degreehiddenid").val();
        self.showempdegreeeditmodal();
      });
      $("#empdegreeTable").on("click", "#empdegreedelete", function () {
        self.id = $("#degreehiddenid").val();
        // self.deleteempdegree();
        self.empdegreeconfirmdelete();
      });

      // if clicked outside of bootstrap modal it hides and cannot catch this event with vue
      // so indiretcly catching this event by vue event "modalonhide" which will fire with a hidden btn click
      // called from this jquery modal hide function  
      $('#empdegreemodal').on('hidden.bs.modal', function () {
        //  $('#degreehiddenmodalonhide').click();
        self.modalonhide();
      });

      var token = this.$apitoken; // for api protection api_token is saved globally in app.js and use here
      var baseurldt = this.$baseURLdt;

      // get the EmpID of Employee(Not the Degree ID) from query parameter to store it in data empid, it is then used in <p>hiddenempid</p>
      // then get the value from the hiddenempid using "var eid=$('#hiddenempid').html();" to use it in datatable parameter
      var eid = this.$route.query.this;
      this.empid = eid;

      $(document).ready(function () {

        // var eid=$('#degreehiddenempid').html();
        var eid = self.empid;

        // function showEmpDegree(empid) {
        // var count = 0;
        // $('#degreelinktab').on('click', function (e) {
        // if (count === 0) {

        //NO SERVERSIDE PROCESSING
        var table = $('#empdegreeTable').DataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bInfo": true,
          "bAutoWidth": true,
          "orderable": true,
          "searchable": false,
          "pageLength": 10,
          "order": [1, "asc"],
          // "width": "130px",
          // "serverSide": true,   
          // "ordering: true,                    
          "processing": true,
          language: {
            // processing: "<img src='images/ajax-loader.gif'>",
            processing: "<img src='/img/loading4.gif'>",
            "loadingRecords": ""
          },
          "ajax": {
            // url: baseurldt+"apiempdegreedata", 
            url: self.$host + "api/empdegree/" + eid,
            headers: {
              // for api protection api_token is saved globally in app.js and use here
              'Authorization': token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
            },
            //"type": "POST",
            "type": "GET",
            "datatype": "json",
            "dataSrc": '', // dont use for server side processing

            // headers: {
            //     // 'Authorization': 'Bearer ' + sessionStorage.getItem("accessToken")
            //     'Authorization': 'Bearer ' + localStorage.getItem("accessToken")
            // },

            // passing empid through GET request to api    
            "data": {
              "EmpID": eid
            },

          },

          "columns": [
            //{ "data": "List_EmpDegree.str1", "width": "100px" },
            // { "data": "degree","defaultContent": "", "width": "100px" },
            //  { "data": "ID", "visible": false },
            { "data": "ID", "visible": false },
            {
              // "data": "Degree", "width":"80px",
              "data": "disDegree",
              // "render": function (data, type, row,self) {
              //   // ** with inline jquery no need to call function from outside vue(masterpage)
              //     return (
              //     // "<a onclick=$('#degreehiddenid').val("+row.ID +");$('#degreehiddenopendetailpage').click(); style='cursor:pointer'>"+ data +"</a>"
              //      "<a onclick=$('#degreehiddenid').val("+row.ID +"); id='empdegreeview' style='cursor:pointer'>"+ data +"</a>"
              //    );
              // }
            }, //for django json format fields.is used
            { "data": "DegreeField" },
            { "data": "Institution" },
            { "data": "YearDegreeEarned" },
            // { "data": "List_State.str1", "width": "50px" },
            // { "data": "List_Country.Str1", "width": "100px" },
            { "data": "disState", "defaultContent": "" },
            { "data": "disCountry", "defaultContent": "" },
            { "data": "Notes", "defaultContent": "", "visible": false },
            //** turned of some fields for following Error
            // Most likely causes:
            // Request filtering is configured on the Web server to deny the request because the query string is too long.
            //{ "data": "Notes", "width": "250px" },
            // { "data": "ID", "visible": false },
            { "data": "EmpID", "visible": false },
            // { "data": "Emp_Main.EmployeeID", "visible": false },
            //{ "data": "ID", "visible": false},
            {
              "data": "ID", "render": function (data, type, row) {
                //         // Condition is used to show or hide buttons according to role
                //         //https://stackoverflow.com/questions/23356505/how-to-get-mvc-c-sharp-user-role-in-jquery

                //         // var userRole = true;
                //         // if (userRole) {
                //         //     return "<a  style='cursor:Pointer' onclick='viewEmpDegree(" + data + ");'>View</a> | <a  style='cursor:Pointer'  onclick='editEmpDegree(" + data + ");'>Edit</a> | <a  style='cursor:Pointer'  onclick='deleteEmpDegree(" + data + ");'>Delete</a>"
                //         // }
                //         // else {
                //         //     return "<a  style='cursor:Pointer' onclick='viewEmpDegree(" + data + ");'>View</a> | <a  style='cursor:Pointer'  onclick='editEmpDegree(" + data + ");'>Edit</a>"
                //         // }
                //         // return "<a  style='cursor:Pointer' onclick='viewEmpDegree(" + data + ");'>View</a> | <a  style='cursor:Pointer'  onclick='addEditEmpDegree(" + data + ");'>Edit</a> | <a  style='cursor:Pointer'  onclick='deleteEmpDegree(" + data + ");'>Delete</a>"

                //         // return "<a  href='/kseprojects/empdegree_detail/" + data + "'>View</a> | <a  href='/kseprojects/update_empdegree/" + data + "/'>Edit</a>"

                // ** with inline jquery no need to call function from outside vue(masterpage)
                return (
                  // "<a onclick=$('#degreehiddenid').val("+row.ID +");$('#degreehiddenopendetailpage').click(); style='cursor:pointer'>View</a> | <a onclick=$('#degreehiddenid').val("+row.ID +");$('#degreehiddenshoweditmodal').click(); style='cursor:pointer'>Edit</a> | <a onclick=$('#degreehiddenid').val("+row.ID +");$('#degreehiddendeleteempdegree').click(); style='cursor:pointer'>Delete</a>"
                  "<a onclick=$('#degreehiddenid').val(" + row.ID + "); id='empdegreeview' style='cursor:pointer'>View</a> | <a onclick=$('#degreehiddenid').val(" + row.ID + "); id='empdegreeedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#degreehiddenid').val(" + row.ID + "); id='empdegreedelete' style='cursor:pointer'>Delete</a>"
                );

              },


            } // end col ID


          ] // end columns


        });//end var table


        // }// end if
        // else {
        //     // table.ajax.reload();
        // }
        // count = 1;


        // } // end function showEmpDegree() 


      }); // End document ready




      // if( create==false){
      setTimeout(() => {
        // set time is used to load combo after parent table is loaded to make table load fast

        // axios.get("/api/apilstJobTitle")
        //         .then((response) => {
        //             this.lstJobTitle = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });

        // this.$http
        //   .get("/api/apilstEmpDegree")
        //   .then(function(response) {
        //     this.lstEmpDegree = response.body;
        //   });



        // axios.get("apilstEmpDegree").then((response) => {
        //             this.lstEmpDegree = response.data
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


        // this.$axios.get("apiempdegreecombogroup").then((response) => {
        //       this.lstEmpDegree = response.data.List_EmpDegree;
        //       this.lstState = response.data.List_State;
        //       this.lstCountry = response.data.List_Country;

        //   }).catch((err) => {
        //       console.log(err)
        //       console.log("going");
        //   });  

        this.$axios.get(this.$host + "api/empcombo/empdegree").then((response) => {
          this.lstEmpDegree = response.data[0].empdegree;
          this.lstState = response.data[1].state;
          this.lstCountry = response.data[2].country;
        });

      }, 1000); // This promise will be resolved in 2000 milli-seconds


      // console.log(this.empid);

    },// end Mounted

  };


</script>



<style>
  /* search combo styles************************************ */
  #empdegreeform .form-group {
    margin-bottom: 5px;
  }

  #empdegreeform label {
    padding-right: 0px;
  }

  #empdegreeform select[type="select"] {
    height: 30px;
    width: 340px;
    border-radius: 2px;
  }

  #empdegreeform input[type="text"] {
    height: 30px;
    width: 340px;
    border-radius: 2px;
  }

  /*align labels left*/
  #empdegreemodal .control-label {
    text-align: left;
    margin-bottom: 0px;
    font-size: 13px;
    color: black;

    /* style="margin-right:0px;padding-left:30px;text-align:left;font-size: 13px; color:black;" */
  }

  /* END search combo styles************************************ */


  /* not working in common css so put in one of the component */
  /* class for processing img, to remove the box around the image */
  .dataTables_processing {
    position: absolute;
    border: none;
    background: transparent;
  }



  /* For fixing top and bottom padding of empdegreetoperrbar ************************************ */
  #empdegreetoperrbar li:first-child {
    padding-top: 6px;

  }

  #empdegreetoperrbar li:last-child {
    padding-bottom: 10px;
  }
</style>