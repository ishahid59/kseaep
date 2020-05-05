<template>
  <div >

<!-- Start Confirm Delete Modal ********************************************* -->
    <div id="prodescconfirmdelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom:5px;background-color:#f1f1f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Delete Confirmation</h3>
                </div>
                <div class="modal-body" style="padding:30px;">
                    Are you sure you want to delete the selected Description <span style="font-size:16px;"><b>'{{prodesc.ItemName}}' </b></span> <br>
                    from project team of project no.<span style="font-size:16px;"><b>'{{prodesc.ProjectNo}}' </b> </span>?<br>
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
  <div class="modal fade" id="prodescdetailmodal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content " style=" width:800px">

        <div
          class="modal-header" style="background-color: #f1f1f1; border-radius: 5px 5px 0 0;  border-bottom: 1px solid lightgrey;  height: 52px; ">
          <button @click="modalclosed"  type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Description Detail</h4>
        </div>

        <div class="modal-body" id="details" style="padding:30px;padding-top:20px; padding-bottom:0px;">
      
          <dl class="dl-horizontal" style="margin-bottom:0px;">
            <!-- <dt>EmployeeID</dt>

            <dd id="ddEmployeeID"> -->
              <!-- https://stackoverflow.com/questions/6584235/django-want-to-display-an-empty-field-as-blank-rather-displaying-none -->
              <!-- {% if not emp.EmployeeID == None %}
              {{emp.EmployeeID}}
              {%endif%}-->
          <!-- {{prodesc.EmployeeID}} -->
              <!-- {{emp.EmployeeID}} -->
            <!-- </dd> -->
            <dt>Project no.</dt>
            <dd id="ddEmployeeID">{{prodesc.ProjectNo}}</dd>    
            <dt>Project name</dt>
            <dd id="ddEmployeeID">{{prodesc.ProjectName}}</dd>  
            <dt>Description item name</dt>
            <dd id="ddEmployeeID" style="margin-bottom:10px;">{{prodesc.ItemName}}</dd>
            <dt >Description</dt>
            <dd id="ddProjectNo" style="line-height:1.35;margin-bottom:10px;">{{prodesc.Description}}</dd>
            <dt >Detail description</dt>
            <dd id="ddEmpProjectRole" style="line-height:1.35;margin-bottom:10px;">{{prodesc.DescriptionPlainText}}</dd>
            <dt >Notes</dt>
            <dd id="ddEmpProjectRole" style="line-height:1.35;margin-bottom:10px;">{{prodesc.Notes}}</dd>
            <dt>Created at</dt>
            <dd id="ddcreatedat">{{prodesc.created_at}}</dd>
            <dt>Updated at</dt>
            <dd id="ddupdatedat">{{prodesc.updated_at}}</dd>
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
  <div class="modal fade" id="prodescmodal" role="dialog">
    <div class="modal-dialog" style="width:850px">
      <!-- Modal content-->
      <div class="modal-content ">
        <div
          class="modal-header "
          style="background-color: #f1f1f1; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 52px; "
        >
          <button @click="modalclosed" type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">Edit Project Team</h4> -->
           <h4 class="modal-title" v-if="addmode">Add Project Description</h4>
           <h4 class="modal-title" v-else>Edit Project Description</h4>
        </div>

        <!-- form in place of modal body div -->
        <!-- <form method="post" class="modal-body" enctype="multipart/form-data" v-on:submit.prevent="updateItem"> -->

        <form
          class="form-horizontal"
          enctype="multipart/form-data"
          v-on:submit.prevent="addupdateItem"
          style="padding:0px;"
          id="prodescform"
        >


        <!-- VALIDATION ERROR: on top of form. validation error(422 (Unprocessable Entity)) -->
        <div 
            id="prodesctoperrbar"
            class="toperrbar"
            >
            <ul><li v-for="item in formErrors">{{ item[0]}}</li></ul>
        </div>



        <div class="modal-body" style="padding-left:50px; padding-bottom:10px;padding-right:30px; padding-top:20px;padding-bottom:20px;">


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





             <div class="form-group" >
              <label
                class="control-label col-sm-3"
              >Description item name</label>
              <div class="col-sm-9" style="padding-left:0px;">
                <select  type="select"  class="form-control" name="ItemName"  id="ItemName"  v-model="formdata.ItemName">
                  <option v-for="item in lstProDesItem" :value="item.ListID">{{ item.Str1 }}</option>
                </select>
               <div style="width:300px;"
                  v-if="formErrors['ItemName']"
                  class="error text-danger"
                 >{{ formErrors['ItemName'][0]}}
                </div>

              </div>
            </div>


            <div class="form-group"  >
              <label
                class="control-label col-sm-3"
              >Description</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-9" style="padding-left:0px;">
                <textarea type="text"  class="form-control"  name="Description" id="Description"  style="height:auto;min-height:100px;margin-top:5px;"  v-model="formdata.Description"
                    ></textarea>
              </div>
            </div>


            <div class="form-group"  >
              <label
                class="control-label col-sm-3"
              >Detail description</label>
              <div class="col-sm-9" style="padding-left:0px;">
                <textarea type="text"  class="form-control"  name="DescriptionPlainText" id="DescriptionPlainText" style="height:auto;min-height:100px;margin-top:5px;"  v-model="formdata.DescriptionPlainText"
                    ></textarea>
              </div>
            </div>


             <div class="form-group"  >
              <label class="control-label col-sm-3" 
              >Notes</label>
              <div class="col-sm-9" style="padding-left:0px;">
                <textarea type="text"  class="form-control"  name="Notes" id="Notes" style="height:auto;min-height:100px; margin-bottom:0px;margin-top:5px;"  v-model="formdata.Notes" ></textarea>
                   <div style="width:340px; "
                    v-if="formErrors['Notes']"
                    class="error text-danger"
                  >{{ formErrors['Notes'][0]}}
                  </div>                 
              </div>
            </div>  



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
    <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer; color:#006fae;" v-on:click="prodescshowaddmodal"><i class="fa fa-plus" style="color:#006fae;"></i> Add New</a>
     <!-- <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;"> For view only</a> -->

    <!-- <table id="empdegreeTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
    <table id="proDescTable" class="table table-striped table-bordered" style="width:100%;">
        <thead >
            <tr>

                <th hidden="hidden">
                    ProjectID
                </th>
                <th>
                    Item Name
                </th>
                <th>
                    Description
                </th>
                <th>
                    Description Plain Text
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
    <!-- <p id="prodeschiddenprojectid" style="display: none">{{projectid}}</p> -->


    <input type="text"  id="prodeschiddenempid"  hidden/><!-- hyperlink employee detail page will store empid-->
    <!-- <h1 id="prodeschiddenopenemployeepage" @click="openemployeedetailpage()" hidden>hiddenopendetailpage</h1>    -->


    <!-- this is the ID col value of Pro_Team table received from row click and used to view detail of protean row -->
    <input type="text"  id="prodeschiddenid"  hidden/>
    <!-- <h1 id="prodeschiddenopendetailpage" @click="prodescopendetailpage()" hidden>hiddenopendetailpage</h1>    
    <h1 id="prodeschiddenshoweditmodal" @click="prodescshoweditmodal()" hidden>hiddenshoweditmodal</h1>  
    <h1 id="prodeschiddendelete" @click="prodescdelete()" hidden>hiddendeleteprodesc</h1>   -->

    <!-- this is used for clicking outside of modal which cannot be catched by modal buttons close event. so fired by jquery -->
    <!-- <h1 id="prodeschiddenmodalonhide" @click="modalonhide()" hidden>hiddenmodalonhide</h1> -->
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
      // empid: 0, // this EmpID value of Pro_Team table used for hyperlink click
      projectid:0, // this is ProjectID col value of Pro_Team table
      id: 0,    // this is ID col value of Pro_Team table
      

      lstProDesItem: [],

      formErrors: {},
    // formErrorsUpdate: {},

    //GENERAL ERROR: Test if any error other than validation error(422 (Unprocessable Entity))
      // errstatus:false, //test
      // errstatusttext:'', //test   



      formdata: {
        ItemName:0, 
        Description:'', 
        DescriptionPlainText:'', 
        Notes:'', 
        ProjectID:0,
        ID:0,
      } ,

      prodesc:{},

     addmode:true, // to switch between updateitem and additem 

    };
  },

  methods:{
    // parentMethodchild(){
    //        alert("prodesc");
    //   },

    modalclosed(){
        this.formErrors="";
        //  this.errstatus=false;
        //  this.errstatusttext=''; 
        //  $("#prodesctoperrbar").hide();  
        $("#prodesctoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition  
         this.addmode=true;         
    },

      // this is for clicking outside of modal which cannot be catched by modal buttons close event
    modalonhide(){
         this.formErrors="";
          
         this.addmode=true; 
         $("#DurationFrom").val(''); // have to clear date with JQuery instead of slearing formdata since it is not binded
         $("#DurationTo").val(''); // have to clear date with JQuery instead of slearing formdata since it is not binded  
      //  $("#prodesctoperrbar").hide();         
         $("#prodesctoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition
    },
      
    clearaddform(){
      // ** Should clear formdata since it could be populated with previous edit data
        this.formdata.ItemName=0;
        this.formdata.Description=''; 
        this.formdata.DescriptionPlainText=''; 
        this.formdata.Notes=''; 
        this.formdata.ProjectID=0;
        this.formdata.ID=0;

        //  this.errstatus=false;
        //  this.errstatusttext='';   

        this.formErrors="";
        // $("#prodesctoperrbar").hide();
        $("#prodesctoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition
         
         this.addmode=true; // must set to true here for extra safety(since modal can hide by clicking outside of modal)

    },



      // View click
    prodescopendetailpage(){

            // this.id = $("#prodeschiddenid").val();

            axios
            .get("apiprodescdetaildata/" + this.id + "").then(response => {
                this.prodesc = response.data[0];

            })
            .catch(err => {
                console.log(err);
            });



            $("#prodescdetailmodal").modal("show");
     },


     // Add click
      prodescshowaddmodal(){

          // var s1=this.$usertype;
          // var s2="admin";
          // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
          //   // alert("You don't have permission to run this operation");
          //   $("#globalunauthorisedmsg").modal("show");
          //   return;
          // } 
      
      
          $('#prodescform').trigger("reset");
          // $('#empform')[0].reset();
          this.clearaddform();  
          this.formdata.ProjectID=this.projectid;// set the mastertable ProjectID for the child table projectid for adding new record   
          $("#prodescmodal").modal("show");
      },



     // Edit click
      prodescshoweditmodal(){

            // var s1=this.$usertype;
            // var s2="admin";
            // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
            // // alert("You don't have permission to run this operation");
            // $("#globalunauthorisedmsg").modal("show");
            // return;
            // }  


            this.addmode=false

            // this.id = $("#prodeschiddenid").val();

        axios
            .get("apiprodesceditdata/" + this.id + "").then(response => {
            this.formdata = response.data[0];
            })
            .catch(err => {
            console.log(err);
            });

            //   alert("Degree Edit form: "+ this.id);
            $("#prodescmodal").modal("show");           
      },



     addupdateItem(){

          var s1=this.$usertype;
          var s2="admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
            // alert("You don't have permission to run this operation");
            $("#globalunauthorisedmsg").modal("show");
            return;
          }        

          let apiurl=''

          if (this.addmode) {
              apiurl="apiprodescadddata/";
          } else {
          //   apiurl="/api/apiemregupdatedata/";
              apiurl="apiprodescupdatedata/";
          }


            //  Foreign key is used in main table for List items col which has to set to null(instead of 0) 
            //  ONDELETE(when a list item row id deleted) as per mysql. 
            //  NOTE: All NULL values are automatically send to the controller as string '' which stores NULL in db 
            //  if default value for the field is NULL. So no need to convert the NULL values here. 
            //  Conversion is needed if FormData is used to send data to controller like Employee.  

           // NOW USING AXIOS      
            axios.post(apiurl, this.formdata).then(response => {
            // axios.post(apiurl, formData).then((response) => {// if response data is needed before catch
                  $("#prodescmodal").modal("hide");

                  toastr.success("Item Updated Successfully.", "Success Alert", {
                    timeOut: 3000
                  });

                  // this.formErrors=""; now done in onmodalhide()
                  $('#proDescTable').DataTable().ajax.reload(); // refresh parent table
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
                        $("#prodescmodal").modal("hide");
                        toastr.error("Could not Save. "+ err.message, "Alert", {
                            timeOut: 5000 //3000
                        });
                        return;
                  }                    

                   if (err.response.status===422) { 
                        this.formErrors = err.response.data; // validation error(422 (Unprocessable Entity))
                        var totalerr=Object.keys(this.formErrors).length //count the number of properties(errors) in a JavaScript object
                        var height=30+(totalerr*20);

                        // $("#prodesctoperrbar").css("height", height+'px');
                        // $('#prodesctoperrbar').slideDown();
                        // $("#prodesctoperrbar").css("transition", 'height 300ms'); // css transition instead of jquery to slide uo and down
                        

                        // Now using css transition instead of jquery to slide uo and down added in master.blade
                        $("#prodesctoperrbar").css("height", height+'px');  
                        // $('#prodesctoperrbar').show();
                        return;
                  } 

                    // GENERAL ERROR: Test  if any error other than validation error(422 (Unprocessable Entity) or Network)
                    $("#prodescmodal").modal("hide");
                        toastr.error("Could not Save. "+ err.response.statusText + " : "+ err.message, "Alert", {
                        timeOut: 5000 //3000
                    });  

              }); // end catch  

      },



      // Delete confirm msg
      prodescconfirmdelete(){
          var s1=this.$usertype;
          var s2="admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
                // alert("You don't have permission to run this operation");
                $("#globalunauthorisedmsg").modal("show");
                return;
          } 


          // to show employeeid and projectno in delete msg since prodesc is not populated yet
          axios
            .get("apiprodescdetaildata/" + this.id + "").then(response => {
                this.prodesc = response.data[0];
          })
            .catch(err => {
                console.log(err);
          });         

          $("#prodescconfirmdelete").modal("show");
      },



      // Delete method
      prodescdelete(){


      //  var confirmdelete = confirm("Are you you want to delete the item?");
      //   if (confirmdelete ==false) {
      //   return;
      // }
           
            // this.id = $("#prodeschiddenid").val(); // this.id now set in mounted under table click

          axios
            .post("apiprodescdeletedata/" + this.id + "").then(response => {

                toastr.success("Deleted item successfully.", "Success Alert", {
                    timeOut: 3000
                    });
                $('#proDescTable').DataTable().ajax.reload(); // refresh parent table
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

      $("#proDescTable").on("click", "#prodescview", function(){
          self.id=$("#prodeschiddenid").val();
          self.prodescopendetailpage();
      });
      $("#proDescTable").on("click", "#prodescedit", function(){
          self.id=$("#prodeschiddenid").val();
          self.prodescshoweditmodal();
      });
      $("#proDescTable").on("click", "#prodescdelete", function(){
          self.id=$("#prodeschiddenid").val();
          // self.prodescdelete();
          self.prodescconfirmdelete();
          // $("#globaldeletemsgchild").modal("show");
      });
      $("#proDescTable").on("click", "#prodescempdetailpage", function(){
          self.empid=$("#prodeschiddenempid").val();
          self.openemployeedetailpage();
      });

        // if clicked outside of bootstrap modal it hides and cannot catch this event with vue
        // so indiretcly catching this event by vue event "modalonhide" which will fire with a hidden btn click
        // called from this jquery modal hide function  
        $('#prodescmodal').on('hidden.bs.modal', function () {
          // $('#prodeschiddenmodalonhide').click();
          self.modalonhide();
        });     



        var token=this.$apitoken;// for api protection api_token is saved globally in app.js and use here
        var baseurldt=this.$baseURLdt;

        // get the id from query parameter to store it in data empid, it is then used in <p>hiddenempid</p>
        // then get the value from the hiddenempid using "var eid=$('#hiddenempid').html();" to use it in datatable parameter
        var proid=this.$route.query.this;
        this.projectid=proid;


        $(document).ready(function () {

            // $("#proDescTable").on("click", "tr", function(){
            //     var rowData = table.row( this ).data();
            //     alert(rowData.ID);
            //     self.id=rowData.ID;
            // });

// $('#proDescTable tbody tr').on( 'click', 'tr', function () {
//      alert( table.row( this ).data() );
//    } );

        // var proid=$('#prodeschiddenprojectid').html();
        var proid=self.projectid;
        
      // delay loading of tab data which are not default
      // setTimeout(() => {

                //NO SERVERSIDE PROCESSING
               var table = $('#proDescTable').DataTable({
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
                        // "url": "/api/apiprodescdata/",// passing empid through POST request to api
                        url: baseurldt+"apiprodescdata",
                        headers: {
                          // Laravel token based api authentication this is retrieved from users/api_token field and added "Bearer " space after
                          // for api protection api_token is saved globally in app.js and use here
                          'Authorization' : token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
                        },
                        "type": "POST",
                        "datatype": "json",
                        "dataSrc": '', // dont use for server side processing

                        // passing empid through GET request to api    
                        "data": {
                            "ProjectID": proid
                        },
        
                    },

                    "columns": [ 
                        { "data": "ProjectID", "visible": false },
                        { "data": "ItemName"},
                        // { "data": "Description"},
                        { "data": "Description","mRender": function(data) {
                          if(data.length > 150){
                              var trimmedString = data.substring(0, 150);
                              return trimmedString + ' ...';
                          } else {
                              return data;
                           }
                        }},
                        { "data": "DescriptionPlainText", "visible": false},
                        { "data": "Notes", "visible": false},
                        { "data": "ID", "render": function (data, type, row) {
                                // ** with inline jquery no need to call function from outside vue(masterpage)
                                return(    
                                    "<a onclick=$('#prodeschiddenid').val("+row.ID +"); id='prodescview' style='cursor:pointer'>View</a> | <a onclick=$('#prodeschiddenid').val("+row.ID +");  id='prodescedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#prodeschiddenid').val("+row.ID +");  id='prodescdelete' style='cursor:pointer'>Delete</a>"
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

            axios.get("apiprodesccombogroup").then((response) => {
                  this.lstProDesItem = response.data.List_ProDesItem;

              }).catch((err) => {
                  console.log(err)
                  console.log("going");
              });  


    }, 200); // This promise will be resolved in 2000 milli-seconds






  }, // end mounted



};
// proDescTable

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

#prodescdetailmodal dt,#prodescdetailmodal dd
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
#prodescform .form-group{
  margin-bottom: 5px;
}
#prodescmodal .control-label{
    padding-left: 0px;
    text-align: left;
    margin-bottom: 0px;
    font-size: 13px;
    color:black;

    /* style="margin-right:0px;padding-left:30px;text-align:left;font-size: 13px; color:black;" */
}
#prodescform select[type="select"] {
   height: 30px;
   width:350px;
   border-radius: 2px;
   color:#333;
}
#prodescform input[type="date"] {
   height: 30px;
   width:350px;
   border-radius: 2px;
   color:#333;
}
#prodescform input[type="text"] {
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
