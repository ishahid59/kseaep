<template>
  <div >

<!-- Start Confirm Delete Modal ********************************************* -->
    <div id="proteamconfirmdelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom:5px;background-color:#f1f1f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Delete Confirmation</h3>
                </div>
                <div class="modal-body" style="padding:30px;">
                    Are you sure you want to delete the selected employee <span style="font-size:16px;"><b>'{{proteam.EmployeeID}}' </b></span> <br>
                    from project team of project no.<span style="font-size:16px;"><b>'{{proteam.ProjectNo}}' </b> </span>?<br>
                    <!-- All related data of the selected employee will also be deleted. -->
                </div>
                <div class="modal-footer">
                    <button @click="deleteempdegree()" type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                    <button  type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>


<!-- Start Detail Modal ********************************************* -->
  <div class="modal fade" id="proteamdetailmodal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content " style=" width:800px">

        <div
          class="modal-header" style="background-color: #f1f1f1; border-radius: 5px 5px 0 0;  border-bottom: 1px solid lightgrey;  height: 52px; ">
          <button @click="modalclosed"  type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Team Detail</h4>
        </div>

        <div class="modal-body" id="details" style="padding:30px;padding-top:20px; padding-bottom:0px;">
      
          <dl class="dl-horizontal" style="margin-bottom:0px;">
            <!-- <dt>EmployeeID</dt>

            <dd id="ddEmployeeID"> -->
              <!-- https://stackoverflow.com/questions/6584235/django-want-to-display-an-empty-field-as-blank-rather-displaying-none -->
              <!-- {% if not emp.EmployeeID == None %}
              {{emp.EmployeeID}}
              {%endif%}-->
          <!-- {{proteam.EmployeeID}} -->
              <!-- {{emp.EmployeeID}} -->
            <!-- </dd> -->
            
            <dt>EmployeeID</dt>
            <dd id="ddEmployeeID">{{proteam.EmployeeID}}</dd>
            <dt>Project No.</dt>
            <dd id="ddProjectNo">{{proteam.ProjectNo}}</dd>
            <dt>Project Name</dt>
            
            <dd id="ddEmpProjectRole">{{proteam.ProjectName}}</dd>
            <dt>Employee Project Role</dt>
            <dd id="ddEmpProjectRole">{{proteam.EmpProjectRole}}</dd>
            <dt>Secondary Project Role</dt>
            <dd id="ddSecProjectRole">{{proteam.SecProjectRole}}</dd>
            <dt>Duration From</dt>
            <dd id="ddDurationFrom">{{proteam.DurationFrom}}</dd>
            <dt>Duration To</dt>
            <dd id="ddDurationTo">{{proteam.DurationTo}}</dd>
            <dt>Months of Experience</dt>
            <dd id="ddMonthsOfExp">{{proteam.MonthsOfExp}}</dd>
            <dt>Created at</dt>
            <dd id="ddcreatedat">{{proteam.created_at}}</dd>

            <dt>Updated at</dt>
            <dd id="ddupdatedat">{{proteam.updated_at}}</dd>

            <dt>Duties & Responsibilities</dt>
            <dd id="ddDutiesAndResponsibilities" style="margin-bottom:20px;line-height:1.65">{{proteam.DutiesAndResponsibilities}}</dd>
            <dt >Notes</dt>
            <dd id="ddNotes" style="line-height:1.65">{{proteam.Notes}}</dd>
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
  <div class="modal fade" id="proteammodal" role="dialog">
    <div class="modal-dialog" style="width:800px">
      <!-- Modal content-->
      <div class="modal-content ">
        <div
          class="modal-header "
          style="background-color: #f1f1f1; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 52px; "
        >
          <button @click="modalclosed" type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">Edit Project Team</h4> -->
           <h4 class="modal-title" v-if="addmode">Add Project Team</h4>
           <h4 class="modal-title" v-else>Edit Project Team</h4>
        </div>

        <!-- form in place of modal body div -->
        <!-- <form method="post" class="modal-body" enctype="multipart/form-data" v-on:submit.prevent="updateItem"> -->

        <form
          class="form-horizontal"
          enctype="multipart/form-data"
          v-on:submit.prevent="addupdateItem"
          style="padding:0px;"
          id="proteamform"
        >


        <!-- VALIDATION ERROR: on top of form. validation error(422 (Unprocessable Entity)) -->
        <div 
            id="proteamtoperrbar"
            class="toperrbar"
            >
            <ul><li v-for="item in formErrors">{{ item[0]}}</li></ul>
        </div>



        <div class="modal-body" style="padding-left:50px; padding-bottom:10px; padding-top:20px;padding-bottom:20px;">


          <!-- protected $fillable = ['Degree', 'DegreeField', 'Institution', 'DegState', 'Country', 'YearDegreeEarned', 'Notes', 'EmpID']; -->
            <div class="form-group" hidden="true">
              <label for="ID">ID</label>
              <input type="text" class="form-control" name="ID" id="ID"  v-model="formdata.ID" />
            </div>


            <!-- <div class="form-group" hidden="true">
              <label for="EmpID">EmpID</label>
              <input type="text" class="form-control" name="EmpID" id="EmpID" v-model="formdata.EmpID" />
            </div> -->

            <div class="form-group" hidden="true">
              <label for="ProjectID">ProjectID</label>
              <input type="text" class="form-control" name="ProjectID" id="ProjectID" v-model="formdata.ProjectID" />
            </div>


             <div class="form-group">
              <label
                class="control-label col-sm-3"

              >Employee</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="EmpID"  id="EmpID" v-model="formdata.EmpID">
                  <option v-for="item in lstEmpID" :value="item.EmpID">{{ item.EmployeeID }}</option>
                </select>
               <div style="width:300px;"
                  v-if="formErrors['EmpID']"
                  class="error text-danger"
                 >{{ formErrors['EmpID'][0]}}
                </div>

              </div>
            </div>


             <div class="form-group" >
              <label
                class="control-label col-sm-3"
              >Employee Project Role</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="EmpProjectRole"  id="EmpProjectRole"  v-model="formdata.EmpProjectRole">
                  <option v-for="item in lstEmpProjectRole" :value="item.ListID">{{ item.Str1 }}</option>
                </select>
               <div style="width:300px;"
                  v-if="formErrors['EmpProjectRole']"
                  class="error text-danger"
                 >{{ formErrors['EmpProjectRole'][0]}}
                </div>

              </div>
            </div>

             <div class="form-group" >
              <label
                class="control-label col-sm-3"
              >Secondary Project Role</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="SecProjectRole"  id="SecProjectRole"  v-model="formdata.SecProjectRole">
                 
                  <option v-for="item in lstEmpProjectRole" :value="item.ListID">{{ item.Str1 }}</option>
                </select>
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
                class="control-label col-sm-3"
               >Duration From</label>
              <div class="col-sm-6">
                <input   type="date" 
                name="DurationFrom"   
                id="DurationFrom"  
                class="form-control startdate"   
                placeholder="mm/dd/yyyy" 
                v-model="formdata.DurationFrom"
                />
     
                  <div style="width:350px; "
                  v-if="formErrors['DurationFrom']"
                  class="error text-danger"
                 >{{ formErrors['DurationFrom'][0]}}
                </div>  

              </div>
            </div>

            <!-- note NOW using v-model because date is send from the controller in format(using carbon 'Y-m-d') recognised
            Note no form v-model binding is used since having problem with html5 date -->
            <!-- Note no form v-model binding is used since having problem with html5 date -->
            <div class="form-group" >
              <label
                class="control-label col-sm-3"
                >Duration To</label>
              <div class="col-sm-6">
                 <input   type="date" 
                 name="DurationTo"   
                 id="DurationTo"  
                 class="form-control startdate" 
                 placeholder="mm/dd/yyyy" 
                 v-model="formdata.DurationTo"
                 />
                 
                  <div style="width:350px; "
                  v-if="formErrors['DurationTo']"
                  class="error text-danger"
                 >{{ formErrors['DurationTo'][0]}}
                </div>  

              </div>
            </div>


            <div class="form-group" >
              <label
                class="control-label col-sm-3"
               >Months of Experience</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-6">
                <input
                  type="text"  class="form-control"  name="MonthsOfExp"  id="MonthsOfExp"  v-model="formdata.MonthsOfExp"
                 />
              </div>
            </div>


            <div class="form-group"  >
              <label
                class="control-label col-sm-3"
              >Duties and Responsibilities</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-9">
                <textarea type="text"  class="form-control"  name="DutiesAndResponsibilities" id="DutiesAndResponsibilities" style="height:auto;min-height:100px;width:520px;margin-top:10px; margin-bottom:10px;"  v-model="formdata.DutiesAndResponsibilities"
                    ></textarea>
              </div>
            </div>


             <div class="form-group"  >
              <label class="control-label col-sm-3" >Notes</label>
           
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-9">
                <textarea type="text"  class="form-control"  name="Notes" id="Notes" style="height:auto;width:520px; margin-bottom:0px;"  v-model="formdata.Notes" ></textarea>
                   <div style="width:340px; "
                    v-if="formErrors['Notes']"
                    class="error text-danger"
                  >{{ formErrors['Notes'][0]}}
                  </div>                 

              </div>
            </div>  


            <!-- <div class="form-group" style="margin-bottom:10px;">
                                           <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 460px;">Close</button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 7px; " id="save">
                        Save changes
                        </button>
            </div> -->


            </div>
            <!-- end modal body -->       


          <div class="modal-footer" style="padding-bottom:20px;">
            <button type="submit" class="btn btn-primary" id="save">Save changes</button>
            <button @click="modalclosed" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>  



        </form>
        <!-- form in place of modal body div -->
      </div>
      <!-- content -->
    </div>
    <!-- end div modal dialog -->
  </div>
  <!-- End Edit Modal ********************************************************-->







<!-- <a id="btnAddModal" href="{% url 'create_empdegree' 1 %}" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;" onclick="addEditEmpDegree(0)"><i class="fa fa-plus"></i> Add New</a>   -->
    <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer; color:#006fae;" v-on:click="proteamshowaddmodal"><i class="fa fa-plus" style="color:#006fae;"></i> Add New</a>
     <!-- <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;"> For view only</a> -->

    <!-- <table id="empdegreeTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
    <table id="proTeamTable" class="table table-striped table-bordered" style="width:100%;">
        <thead >
            <tr>

                <th hidden="hidden">
                    ProjectID
                </th>
                <th hidden="hidden">
                    EmpID
                </th>
                <th>
                    EmployeeID
                </th>
                <th>
                    Employee project role
                </th>
                <th>
                    Secondary project role
                </th>
                <th>
                    Duties and responsibilities
                </th>
    
                <th>
                    Duration from
                </th>
                <th>
                    Duration to
                </th>
                <th>
                    Months
                </th>
                <th>
                    Notes
                </th>

                <th hidden="hidden">
                    ID
                </th>
                <th style="width:130px;">Action</th>
    
    
            </tr>
        </thead>
    
    </table>

<!-- this will store the empid on datatable row click -->
    <!-- <input type="text"  id="projecthiddenid"  hidden/> 
    <h1 id="projecthiddenopendetailpage" @click="openprojectdetailpage()" hidden>hiddenopendetailpage</h1> -->


    <!-- when mounted projectid is saved from route using "var proid=this.$route.query.this;" -->
    <!-- this projectid is used to fill datatable on load -->
    <!-- <p id="proteamhiddenprojectid" style="display: none">{{projectid}}</p> -->


    <input type="text"  id="proteamhiddenempid"  hidden/><!-- hyperlink employee detail page will store empid-->
    <!-- <h1 id="proteamhiddenopenemployeepage" @click="openemployeedetailpage()" hidden>hiddenopendetailpage</h1>    -->


    <!-- this is the ID col value of Pro_Team table received from row click and used to view detail of protean row -->
    <input type="text"  id="proteamhiddenid"  hidden/>
    <!-- <h1 id="proteamhiddenopendetailpage" @click="proteamopendetailpage()" hidden>hiddenopendetailpage</h1>    
    <h1 id="proteamhiddenshoweditmodal" @click="proteamshoweditmodal()" hidden>hiddenshoweditmodal</h1>  
    <h1 id="proteamhiddendelete" @click="proteamdelete()" hidden>hiddendeleteproteam</h1>   -->

    <!-- this is used for clicking outside of modal which cannot be catched by modal buttons close event. so fired by jquery -->
    <!-- <h1 id="proteamhiddenmodalonhide" @click="modalonhide()" hidden>hiddenmodalonhide</h1> -->
<!-- <globaldeletemsgchild /> -->
  </div>
</template>


<script>
export default {
  name: "empprojecttabcontent",
  components: {
    // empcolselector,
    // empeditmodal
  },
  data() {
    return {
      empid: 0, // this EmpID value of Pro_Team table used for hyperlink click
      projectid:0, // this is ProjectID col value of Pro_Team table
      id: 0,    // this is ID col value of Pro_Team table
      
      lstEmpID:[],  
      lstEmpProjectRole: [],

      formErrors: {},
    // formErrorsUpdate: {},

    //GENERAL ERROR: Test if any error other than validation error(422 (Unprocessable Entity))
      // errstatus:false, //test
      // errstatusttext:'', //test   



      formdata: {
        EmpProjectRole:0, 
        SecProjectRole:0,
        DutiesAndResponsibilities:'', 
        DurationFrom:'', 
        DurationTo:'', 
        MonthsOfExp:'', // 0.00 used '' to avoid showing 0 in add
        Notes:'', 
        EmpID:0,
        ProjectID:0,
        ID:0,
      } ,

      proteam:{},

     addmode:true, // to switch between updateitem and additem 

    };
  },

  methods:{
    // parentMethodchild(){
    //        alert("proteam");
    //   },

    modalclosed(){
        this.formErrors="";
        //  this.errstatus=false;
        //  this.errstatusttext=''; 
        //  $("#proteamtoperrbar").hide();  
        $("#proteamtoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition  
         this.addmode=true;         
    },

      // this is for clicking outside of modal which cannot be catched by modal buttons close event
    modalonhide(){
         this.formErrors="";
          
         this.addmode=true; 
         $("#DurationFrom").val(''); // have to clear date with JQuery instead of slearing formdata since it is not binded
         $("#DurationTo").val(''); // have to clear date with JQuery instead of slearing formdata since it is not binded  
      //  $("#proteamtoperrbar").hide();         
         $("#proteamtoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition
    },
      
    clearaddform(){
      // ** Should clear formdata since it could be populated with previous edit data
        this.formdata.EmpProjectRole=0;
        this.formdata.SecProjectRole=0; 
        this.formdata.DutiesAndResponsibilities=''; 
        this.formdata.DurationFrom=''; 
        this.formdata.DurationTo='';
        this.formdata.MonthsOfExp='', // 0.00 used '' to avoid showing 0 in add
        this.formdata.Notes=''; 
        this.formdata.EmpID=0;
        this.formdata.ProjectID=0;
        this.formdata.ID=0;

        //  this.errstatus=false;
        //  this.errstatusttext='';   

        this.formErrors="";
        // $("#proteamtoperrbar").hide();
        $("#proteamtoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition
         
         this.addmode=true; // must set to true here for extra safety(since modal can hide by clicking outside of modal)

    },

      // Hyperlink click EmployeeID
    openemployeedetailpage(){

            // this.empid = $("#proteamhiddenempid").val();

            // code to open empdetail page router view by passing the empid value
            // this.$router.push('empdetail', {params: { empid: 5}})

            //  this.$router.push('empdetail')
            this.$router.push({
              name: "empdetail", // name property of this route must be used in route list to use with parameter
              params: { empid: this.empid },
              query:{this: this.empid} // query param is used to pass empid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
            });

    },


      // View click
    proteamopendetailpage(){

            // this.id = $("#proteamhiddenid").val();

            this.$axios
            .get(this.$host+"api/proteam/details/" + this.id + "").then(response => {
                this.proteam = response.data[0];

            // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'm/d/Y')
            // // to show hiredate in detail modal in mm/dd/yyyy format
            // // to show date in detail modal in mm/dd/yyyy format
            // if (this.proteam.DurationFrom!=null) {
            //     let userDate = this.proteam.DurationFrom;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");
            //     this.proteam.DurationFrom=date_string;
            //     // $("#ddDurationFrom").html('');
            // }
            // if (this.proteam.DurationTo!=null) {
            //     let userDate = this.proteam.DurationTo;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");
            //     this.proteam.DurationTo=date_string;
            //     // $("#ddDurationTo").html('');
            // }

            // // to show blank in detail modal if date is default '1900-01-01 00:00:00'
            // if (this.proteam.DurationFrom==='01/01/1900') {
            //     this.proteam.DurationFrom="";
            //     // $("#ddDurationFrom").html('');
            // }
            // if (this.proteam.DurationTo==='01/01/1900') {
            //     this.proteam.DurationTo="";
            //     // $("#ddDurationTo").html('');
            // }
            // if (this.proteam.created_at!=null) {
            //     let userDate = this.proteam.created_at;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
            //     this.proteam.created_at=date_string;
            // }
            // if (this.proteam.updated_at!=null) {
            //     let userDate = this.proteam.updated_at;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
            //     this.proteam.updated_at=date_string;
            // }


            })
            .catch(err => {
                console.log(err);
            });



            $("#proteamdetailmodal").modal("show");
     },


     // Add click
      proteamshowaddmodal(){

          // var s1=this.$usertype;
          // var s2="admin";
          // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
          //   // alert("You don't have permission to run this operation");
          //   $("#globalunauthorisedmsg").modal("show");
          //   return;
          // } 
      
      
          $('#proteamform').trigger("reset");
          // $('#empform')[0].reset();
          this.clearaddform();  
          this.formdata.ProjectID=this.projectid;// set the mastertable ProjectID for the child table projectid for adding new record   
          $("#proteammodal").modal("show");
      },



     // Edit click
      proteamshoweditmodal(){

            // var s1=this.$usertype;
            // var s2="admin";
            // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
            // // alert("You don't have permission to run this operation");
            // $("#globalunauthorisedmsg").modal("show");
            // return;
            // }  


            this.addmode=false

            // this.id = $("#proteamhiddenid").val();

           
        this.$axios
            .get(this.$host+"api/proteam/edit/" + this.id + "").then(response => {
            // this.formdata = response.data[0];
            this.formdata = response.data;

            // have to use this if date is present
            // to use html5 date we have to convert date format since it cannot read
            // (html date has masking which jquery datepicker dont have which is essential for preventing wrong data with server error
            // so moment is used to convert date to YYYY-MM-DD which html date can read 
            //http://jsfiddle.net/r42jg/303/


            // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'Y-m-d')
            // // so that it is recognised by html datepicker which is yyyy-MM-dd            
            // if (this.formdata.DurationFrom!==null) {
            //     let userDate = this.formdata.DurationFrom;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY.MM.DD").format("YYYY-MM-DD");
            //     $("#DurationFrom").val(date_string);
            // }
            // if (this.formdata.DurationTo!==null) {
            //     let userDate = this.formdata.DurationTo;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY.MM.DD").format("YYYY-MM-DD");
            //     $("#DurationTo").val(date_string);
            // }


            //NOT REQUIRED if nullable is used in validation and database******************************************** */

            // // to show '' (instead of 01/01/1900) in html datepicker box when data is default date of '1900-01-01 00:00:00'
            // // since html5 datepicker always put '1900-01-01 00:00:00' instead of null
            // if (this.formdata.DurationFrom=='1900-01-01 00:00:00') {
            //     $("#DurationFrom").val('');
            // }
            // if (this.formdata.DurationTo=='1900-01-01 00:00:00') {
            //     $("#DurationTo").val('');
            // }
            //************************************************************************************************************ */


            })
            .catch(err => {
            console.log(err);
            });

            $("#proteammodal").modal("show");           
      },



     addupdateItem(){

          var s1='admin'// blocked for test//this.$usertype;
          var s2="admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
            alert("You don't have permission to run this operation");
            // $("#globalunauthorisedmsg").modal("show");
            return;
          }        

          let apiurl=''

          if (this.addmode) {
              // apiurl="apiproteamadddata/";
              apiurl=this.$host + "api/proteam";
          } else {
          //   apiurl="/api/apiemregupdatedata/";
              apiurl=this.$host + "api/proteam/update";

          // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'Y-m-d')
          // // so that it is recognised by html datepicker which is yyyy-MM-dd
          // // and thus we can use model binding for date
          //     // have to use this if date field is present
          //     this.formdata.DurationFrom=$("#DurationFrom").val();// manually set value since DurationFrom is not binded
          //     this.formdata.DurationTo=$("#DurationTo").val();// manually set value since DurationTo is not binded

          }



            //NOT REQUIRED if nullable is used in validation and database******************************************** */
            // // have to use this if date field is present
            // // have to use " 00:00:00" with date else will not update
            // var str=$("#DurationFrom").val()+" 00:00:00"
            // this.formdata.DurationFrom=str;//"2019-08-04 13:17:29";

            // var str1=$("#DurationTo").val()+" 00:00:00"
            // this.formdata.DurationTo=str1;//"2019-08-04 13:17:29";

            // // this.$http.post("/api/apiempupdatedata/", this.formData).then(


            // //added for Mysql database
            // if ($("#DurationFrom").val()==='') {
            //   this.formdata.DurationFrom="1900-01-01 00:00:00";//"2019-08-04 13:17:29";
            // }
            // if ($("#DurationTo").val()==='') {
            //   this.formdata.DurationTo="1900-01-01 00:00:00";//"2019-08-04 13:17:29";
            // }
            //********************************************************************************************************** */


            //  Foreign key is used in main table for List items col which has to set to null(instead of 0) 
            //  ONDELETE(when a list item row id deleted) as per mysql. 
            //  NOTE: All NULL values are automatically send to the controller as string '' which stores NULL in db 
            //  if default value for the field is NULL. So no need to convert the NULL values here. 
            //  Conversion is needed if FormData is used to send data to controller like Employee.  

           // NOW USING AXIOS      
            this.$axios.post(apiurl, this.formdata).then(response => {
            // axios.post(apiurl, formData).then((response) => {// if response data is needed before catch
                  $("#proteammodal").modal("hide");

                  toastr.success("Item Updated Successfully.", "Success Alert", {
                    timeOut: 3000
                  });

                  // this.formErrors=""; now done in onmodalhide()
                  $('#proTeamTable').DataTable().ajax.reload(); // refresh parent table
                  this.addmode=true; //now done in onmodalhide(), still used here

                  // if (this.formErrors === "") {
                  //       this.addmode=true; // set to default true, For edit it is set to false in loadeditdata() method
                  //       console.log("Updated from addmode: "+ this.addmode);
                  // }                      

              })
              .catch((err) => {
                  console.log(err)

                  //axios Network Error doesnt have err.response.status, so used seperate condition
                   if (err.message==="Network Error") {
                        $("#proteammodal").modal("hide");
                        toastr.error("Could not Save. "+ err.message, "Alert", {
                            timeOut: 5000 //3000
                        });
                        return;
                  }                    

                   if (err.response.status===422) { 
                        this.formErrors = err.response.data; // validation error(422 (Unprocessable Entity))
                        var totalerr=Object.keys(this.formErrors).length //count the number of properties(errors) in a JavaScript object
                        var height=30+(totalerr*20);

                        // $("#proteamtoperrbar").css("height", height+'px');
                        // $('#proteamtoperrbar').slideDown();
                        // $("#proteamtoperrbar").css("transition", 'height 300ms'); // css transition instead of jquery to slide uo and down
                        

                        // Now using css transition instead of jquery to slide uo and down added in master.blade
                        $("#proteamtoperrbar").css("height", height+'px');  
                        // $('#proteamtoperrbar').show();
                        return;
                  } 

                    // GENERAL ERROR: Test  if any error other than validation error(422 (Unprocessable Entity) or Network)
                    $("#proteammodal").modal("hide");
                        toastr.error("Could not Save. "+ err.response.statusText + " : "+ err.message, "Alert", {
                        timeOut: 5000 //3000
                    });  

              }); // end catch  

      },



      // Delete confirm msg
      proteamconfirmdelete(){
          var s1 = "admin"; //test blocked//this.$usertype;
          var s2="admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
                alert("You don't have permission to run this operation");
                // $("#globalunauthorisedmsg").modal("show");
                return;
          } 


          // to show employeeid and projectno in delete msg since proteam is not populated yet
          this.$axios
            // .get("apiproteamdetaildata/" + this.id + "").then(response => {
              .get(this.$host+"api/proteam/view/" + this.id + "").then(response => {
                this.proteam = response.data[0];
          })
            .catch(err => {
                console.log(err);
          });         

          $("#proteamconfirmdelete").modal("show");
      },



      // Delete method
      proteamdelete(){


      //  var confirmdelete = confirm("Are you you want to delete the item?");
      //   if (confirmdelete ==false) {
      //   return;
      // }
           
            // this.id = $("#proteamhiddenid").val(); // this.id now set in mounted under table click

           this.$axios
            .delete(this.$host+"api/proteam/" + this.id + "").then(response => {

                toastr.success("Deleted item successfully.", "Success Alert", {
                    timeOut: 3000
                    });
                $('#proTeamTable').DataTable().ajax.reload(); // refresh parent table
            })
            .catch(err => {
                console.log(err);

                // Display a warning toast, with no title
                toastr.error("Could not delete. "+err, "Alert", {
                    timeOut: 5000 //3000
                });

            });// end catch

        }
      

  },



  mounted() {
      
      // Datatable action col click events now from mounted instead of hidden button click
      // call vue data inside jquery
      // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component

      var self = this;

      $("#proTeamTable").on("click", "#proteamview", function(){
          self.id=$("#proteamhiddenid").val();
          self.proteamopendetailpage();
      });
      $("#proTeamTable").on("click", "#proteamedit", function(){
          self.id=$("#proteamhiddenid").val();
          self.proteamshoweditmodal();
      });
      $("#proTeamTable").on("click", "#proteamdelete", function(){
          self.id=$("#proteamhiddenid").val();
          // self.proteamdelete();
          self.proteamconfirmdelete();
          // $("#globaldeletemsgchild").modal("show");
      });
      $("#proTeamTable").on("click", "#proteamempdetailpage", function(){
          self.empid=$("#proteamhiddenempid").val();
          self.openemployeedetailpage();
      });

        // if clicked outside of bootstrap modal it hides and cannot catch this event with vue
        // so indiretcly catching this event by vue event "modalonhide" which will fire with a hidden btn click
        // called from this jquery modal hide function  
        $('#proteammodal').on('hidden.bs.modal', function () {
          // $('#proteamhiddenmodalonhide').click();
          self.modalonhide();
        });     



        var token=this.$apitoken;// for api protection api_token is saved globally in app.js and use here
        var baseurldt=this.$baseURLdt;

        // get the id from query parameter to store it in data empid, it is then used in <p>hiddenempid</p>
        // then get the value from the hiddenempid using "var eid=$('#hiddenempid').html();" to use it in datatable parameter
        var proid=this.$route.query.this;
        this.projectid=proid;


        $(document).ready(function () {

            // $("#proTeamTable").on("click", "tr", function(){
            //     var rowData = table.row( this ).data();
            //     alert(rowData.ID);
            //     self.id=rowData.ID;
            // });

// $('#proTeamTable tbody tr').on( 'click', 'tr', function () {
//      alert( table.row( this ).data() );
//    } );

        // var proid=$('#proteamhiddenprojectid').html();
        var proid=self.projectid;
        
      // delay loading of tab data which are not default
      // setTimeout(() => {

                //NO SERVERSIDE PROCESSING
               var table = $('#proTeamTable').DataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bInfo": true,
                    "bAutoWidth": true,
                    "orderable": false,
                    "searchable": false,
                    // "width": "100px",
                    "pageLength": 10,
                    "order": [2, "asc"], // order by EmployeeID    
                    // "serverSide": true,                    
                    "processing": true,
                    language: {
                    // processing: "<img src='/media/icons/ajax-loader.gif'>"
                    processing: "<img src='images/ajax-loader.gif'>",
                    //  "loadingRecords": ""
                    },    
                    
 
                    "ajax": {
                        // "url": "/api/apiproteamdata/",// passing empid through POST request to api
                        // url: baseurldt+"apiproteamdata",
                        url: self.$host+"api/proteam/"+proid,
                        headers: {
                          // Laravel token based api authentication this is retrieved from users/api_token field and added "Bearer " space after
                          // for api protection api_token is saved globally in app.js and use here
                          'Authorization' : token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
                        },
                        // "type": "POST",
                        "type": "GET",
                        "datatype": "json",
                        "dataSrc": '', // dont use for server side processing

                        // // passing empid through GET request to api    
                        // "data": {
                        //     "ProjectID": proid
                        // },
        
                    },

                    "columns": [ 
                      { "data": "ProjectID", "visible": false },
                      { "data": "EmpID", "visible": false },
                      // to limit the string. https://stackoverflow.com/questions/31809932/datatable-cell-string-truncate
                      { "data": "disEmployeeID","mRender": function(data, type, row) {
                          if(data.length > 70){
                              var trimmedString = data.substring(0, 70);
                              // trimmedString + '...';
                            return   "<a onclick=$('#proteamhiddenempid').val("+row.EmpID +"); id='proteamempdetailpage' style='cursor:pointer;color: #006fae'>"+ trimmedString + '...' +"</a>"
                          } else {
                              return "<a onclick=$('#proteamhiddenempid').val("+row.EmpID +"); id='proteamempdetailpage' style='cursor:pointer;color: #006fae'>"+ data +"</a>";
                           }
                      }},


                        // {
                        // "data": "ProjectID", "render": function (data, type, row) {
                        // return (
                        //     "<a onclick=$('#reghiddenid').val("+row.ID +");$('#reghiddenopendetailpage').click(); style='cursor:pointer'>"+ data +"</a>"
                        //     );
                        //    }
                        // }, 
                        { "data": "disEmpProjectRole","mRender": function(data) {
                          if(data.length > 70){
                              var trimmedString = data.substring(0, 70);
                              return trimmedString + '...';
                          } else {
                              return data;
                           }
                        }},
                        { "data": "disSecProjectRole","mRender": function(data) {
                          if(data.length > 70){
                              var trimmedString = data.substring(0, 70);
                              return trimmedString + '...';
                          } else {
                              return data;
                           }
                        }},
                        { "data": "DutiesAndResponsibilities", "visible": false  },

                        // https://datatables.net/plug-ins/dataRender/datetime
                        // https://datatables.net/forums/discussion/25196/render-date-and-retain-order-functionality-ajax-object
                        {
                            "data": "DurationFrom", "render": function (data, type, row) {
                                if (data == null) { // to replace "Invalid Date" with "", happens when date field is NULL
                                    return "";
                                }
                                if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                                    return "";
                                }
                                	
                                else {
                                    return (moment(data).format("MM/DD/YYYY"));
                                }
                            }
                        },
        
                        {
                            "data": "DurationTo", "render": function (data, type, row) {
                                if (data == null) { // to replace "Invalid Date" with "", happens when date field is NULL
                                    return "";
                                }
                                if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                                    return "";
                                }
                                else {
                                    return (moment(data).format("MM/DD/YYYY"));
                                }
                            }
                        },

                        { "data": "MonthsOfExp" },
                        { "data": "Notes" , "visible": false },
                        // { "data": "EmpID", "visible": false  },
                        { "data": "ID", "render": function (data, type, row) {
                                // ** with inline jquery no need to call function from outside vue(masterpage)
                                return(    
                                    "<a onclick=$('#proteamhiddenid').val("+row.ID +"); id='proteamview' style='cursor:pointer'>View</a> | <a onclick=$('#proteamhiddenid').val("+row.ID +");  id='proteamedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#proteamhiddenid').val("+row.ID +");  id='proteamdelete' style='cursor:pointer'>Delete</a>"
                                );
                             },
                         } // end col ID
                       

                    ] // end columns
        
        
                });//end var table

// }, 2000) 







    }) // End document ready




    setTimeout(() => {


        //  axios.get("apilstEmpID").then((response) => {
        //           this.lstEmpID = response.data
        //       }).catch((err) => {
        //           console.log(err)
        //       }); 

        //  axios.get("apilstEmpProjectRole").then((response) => {
        //           this.lstEmpProjectRole = response.data
        //       }).catch((err) => {
        //           console.log(err)
        //       });     
        


      // now receiving all combo in one request under a group
      // ***********************************************************************

            // axios.get("apiproteamcombogroup").then((response) => {
            //       this.lstEmpID = response.data.Emp_Main;
            //       this.lstEmpProjectRole = response.data.List_EmpProjectRole;

            //   }).catch((err) => {
            //       console.log(err)
            //       console.log("going");
            //   });  

             this.$axios.get(this.$host+"api/procombo/proteam").then((response) => {
                  this.lstEmpID = response.data.Emp_Main;
                  this.lstEmpProjectRole = response.data.List_EmpProjectRole;

              }).catch((err) => {
                  console.log(err)
                  console.log("going");
              });            


    }, 200); // This promise will be resolved in 2000 milli-seconds






  }, // end mounted



};
// proTeamTable

</script>



<style>

#details dt {
  /* font-family: "Roboto", Arial, Helvetica, sans-serif; */
  font-family: "Helvetica", Arial, sans-serif;
  font-size: 13px !important ;
  /* letter-spacing: -0.2px; */
    /* margin-right:-40px; */
  text-align: left;
  /* letter-spacing: -.3px; */
  /* letter-spacing: 0.1px; */
  color: #000000;

}

/*to align thead dt labels left*/
.dl-horizontal dt {
  text-align: left;

}

#proteamdetailmodal dt,#proteamdetailmodal dd
 {
  font-family: "Helvetica", Arial, sans-serif;
  /* line-height: 1.72857143; */
   line-height: 2.0;
/* font-family: "Roboto", Arial, Helvetica, sans-serif; */
  font-size: 13px;
  
}

#details dt {
  color: #333;
}





/* search combo styles************************************ */
#proteamform .form-group{
  margin-bottom: 5px;
}
#proteammodal .control-label{
    padding-left: 0px;
    text-align: left;
    margin-bottom: 0px;
    font-size: 13px;
    color:black;

    /* style="margin-right:0px;padding-left:30px;text-align:left;font-size: 13px; color:black;" */
}
#proteamform select[type="select"] {
   height: 30px;
   width:350px;
   border-radius: 2px;
   color:#333;
}
#proteamform input[type="date"] {
   height: 30px;
   width:350px;
   border-radius: 2px;
   color:#333;
}
#proteamform input[type="text"] {
   height: 30px;
   width:350px;
   border-radius: 2px;
   color:#333;
}
/*align labels left*/

/* END search combo styles************************************ */

/* not working in common css so put in one of the component */
/* class for processing img, to remove the box around the image */
.dataTables_processing{
  position: absolute;
  border: none;
  background: transparent;
}

</style>
