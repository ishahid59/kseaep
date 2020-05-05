<template>
  <div>


    <div id="proconfirmdelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#f1f1f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Delete Confirmation</h3>
                </div>
                <div class="modal-body" style="padding:30px;">
                    Are you sure you want to delete the selected project <span style="font-size:16px;"><b>'{{this.project.ProjectNo}}' </b></span>?<br>
                    All related data of the selected project will also be deleted.
                </div>
                <div class="modal-footer">
                    <button @click="deleteproject()" type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                    <button  type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>



    <!-- <h2 style="margin-top:5px;margin-bottom:7px;">{{emp.EmployeeID}}</h2> -->
<!-- <h2 style="margin-top:5px;margin-bottom:7px;color:#000">Detail: <span class="small">{{project.ProjectNo}}</span></h2> -->



    <div class="row" style="margin:0px;padding:0px;margin-bottom:4px;">
        <div class="col-sm-3" style="padding-left:0px;">
              <h2 style="margin-top: 10px; margin-bottom: 1px; font-size:25px;font-family: 'Helvetica', Arial, sans-serif;">Project Detail <span class="small" style="margin-left:2px">{{project.ProjectNo}}</span></h2>
        </div>




      <!-- <prosearchbar/> -->
        <!-- <div class="col-sm-4" style="padding-right:0px;margin-top:0px;margin-left:70px;">
              <div class="form-group" >
                <div class="col-sm-5" style="height: 30px;padding-top: 3px;padding-left: 7px;margin-left: 128px;margin-bottom: 2px;">
                  <select 
                      class="form-control" 
                      style="height:33px;width:286px;"
                      id="selectprojectno" 
                      data-live-search="true" 
                      data-style="btn btn-default btn-sm" 
                      data-size="23"
                      data-width="286px"
                      data-none-selected-text="Find a Project"
                      data-display="static"
                  >
                    <option v-for="item in lstProjectID" :value="item.ProjectID">{{ item.ProjectNo }} : {{item.ProjectName }}</option>
                  </select>
                  
                  </div>
                </div>
              </div>
           <a @click="findbyprojectno()" class="btn btn-default pull-right" style="height:33px;width:35px;margin-top:3px; padding-top:6px;padding-left:8px;font-size:13px;color:#636b6f">Go</a> -->
  




        <!-- TEST BOOT SELECT -->
        <!-- Bootstrap select https://www.youtube.com/watch?v=lg1d0QaQLe0 -->
        <!-- https://www.webslesson.info/2017/05/bootstrap-multi-select-dropdown-with-checkboxes-using-jquery-in-php.html -->
        <!-- For styling and avoiding button going out of container http://jsfiddle.net/MansukhKhandhar/4309n31p/1/ -->
        <div class="col-sm-9" style="padding-right:0px;">

            <div class="input-group my-group pull-right" style="height:32px; width:325px;margin-top:5px;"> 
                <!-- class form-control and style is added to select to avoid only showing button first on refresh -->
                <!-- note: binding is not used since it needs array to check items -->
                <select id="selectprojectno" class="form-control" style="height:32px;width:278px;margin-right:0px;"
                        data-live-search="true" 
                        data-size="20"
                        title="Find project ..."

                    >
                      <option v-for="item in lstProjectID" :value="item.ProjectID">{{ item.ProjectNo }} : {{item.ProjectName }}</option>
                </select> 
                <span class="input-group-btn">
                  <button @click="findbyprojectno()" class="btn btn-default"  style="height:32px;padding-top:4px;">GO</button>
                </span>

            </div>
        </div>

    </div>
    <!-- row -->










    <!-- <h2 style="margin-top:15px;margin-bottom:5px;padding-right:0px;padding-left:14px;padding-bottom:0px;">{{emp.EmployeeID}}</h2> -->

    <!-- <div class="container" id="details" style="margin-top:20px;"> -->
    <div id="details" style="margin-top:0px;">
      
      <div
        class="row"
        style="margin-top:0px;margin-left:0px;margin-right:0px;padding:15px;padding-left:10px;padding-bottom:10px; border:1px solid #afafaf; border-radius: 4px;"
      >
        <div class="col-sm-5">
          <dl class="dl-horizontal" >
            <dt hidden>Project ID</dt>
            <dd id="ddProjectName" hidden>{{project.ProjectID}}</dd>

            <dt>ProjectNo</dt>

            <dd id="ddProjectNo">
              <!-- https://stackoverflow.com/questions/6584235/django-want-to-display-an-empty-field-as-blank-rather-displaying-none -->
              <!-- {% if not emp.EmployeeID == None %}
              {{emp.EmployeeID}}
              {%endif%}-->

              {{project.ProjectNo}}
            </dd>
            <dt>Project Name</dt>
            <dd id="ddProjectName">{{project.ProjectName}}</dd>
            <dt>Project Role</dt>
            <dd id="ddProjectRole">{{project.disProjectRole}}</dd>
            <dt>Award Year</dt>
            <dd id="ddAwardYear">{{project.AwardYear}}</dd>
            <dt>Owner Category</dt>
            <dd id="ddOwnerCategory">{{project.disOwnerCategory}}</dd>
            <dt>Owner</dt>
            <dd id="ddOwner">{{project.disOwner}}</dd>
            <dt>Client</dt>
            <dd id="ddClient">{{project.disClient}}</dd>
            <dt>Company Name</dt>
            <dd id="ddComID">{{project.disComID}}</dd>

          </dl>
        </div>


        <div class="col-sm-4"  >
          <dl class="dl-horizontal" style=" margin-top:0; margin-bottom:0px;">


            <dt>Primary Project Type</dt>
            <dd id="ddPrimaryProjectType">{{project.disPrimaryProjectType}}</dd>
            <dt>Secondary Pro. Type</dt>
            <dd id="ddSecondaryProjectType">{{project.SecondaryProjectType}}</dd>            
            <dt>Project Manager</dt>
            <dd id="ddProjectManager">{{project.disProjectManager}}</dd>
            <dt>Project Agreement No.</dt>
            <dd id="ddProjectAgreementNo">{{project.ProjectAgreementNo}}</dd>
            <dt>Proposal No.</dt>
            <dd id="ddProposalID">{{project.disProposalID}}</dd>
            <dt>Project Status</dt>
            <dd id="ddProjectStatus">{{project.disProjectStatus}}</dd>     

            <dt>Created at</dt>
            <dd id="ddcreatedat">{{project.created_at}}</dd>

            <dt>Updated at</dt>
            <dd id="ddupdatedat">{{project.updated_at}}</dd>
            <!-- <dt>ImageData</dt>
            <dd id="ddImageData">{{emp.ImageData}}</dd> -->
          </dl>

        </div>

        <div class="col-sm-3 pull-right" style="margin-left:0px;padding-right:0px;">
          
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


          <!-- <a  type="button" class="btn btn-default btn-sm pull-right  " style="margin-left:5px;color:#006fae;" @click="showproeditmodal()">Edit Project</a>  
          <a  type="button" class="btn btn-default btn-sm pull-right  " style="margin-left:0px;color:#006fae;" @click="backtoproject()">Back to Project List</a>  
          <button id="refreshproject" @click="refreshprodetail()" hidden>Refresh Project</button> -->

            <div style="width:100%;"> &nbsp; 
                <a @click="backtoproject()" class="pull-right" style="font-size:12px;color:#006fae;cursor:pointer">Back to List </a>
            </div>  

           <div style="width:100%;padding-top:165px;"> &nbsp;     
                <!-- <a @click="proconfirmdelete()" type="button" class="btn btn-default btn-sm pull-right" style="margin-left:6px;color:#006fae;"><span class="glyphicon glyphicon-remove " style="color:#c47676"></span> Delete Project </a>  
                <a @click="showproeditmodal()" type="button" class="btn btn-default btn-sm pull-right" style="color:#006fae;"><i class="fa fa-edit" style="font-size:14px;color:green;"></i> Edit Project</a>   -->
                 <a @click="proconfirmdelete()" type="button" class="btn btn-danger btn-sm pull-right" style="margin-left:6px;width:100px"> Delete </a>  
                <a @click="showproeditmodal()" type="button" class="btn btn-primary btn-sm pull-right" style="width:100px"> Edit</a>                
                
                <!-- this hidden btn is clicked by a jquery trigger event to refresh project -->
                <!-- <button id="refreshproject" @click="refreshprodetail()" hidden>Refresh Project</button> -->
            </div>          

        </div>


      </div><!--  end row -->
      

      <!-- <div style="background-color:#d6d6d6;height:1px;margin-top: 15px;"></div> -->
    </div><!--  end detail -->
    





    <!-- <div class="container" style="margin-top:20px"> -->
    <div style="margin-top:20px; ">
      <ul id="navtabs" class="nav nav-tabs">

        <!-- Dynamically load child component on click -->
        <!-- <li class="active" @click="showcomponent">  -->
        <li @click="hideprophotoadd()" class="active">  
          <a  id="proteamlinktab" data-toggle="tab" href="#proteamtab">Project Team</a>
        </li>

        <li @click="hideprophotoadd()">  
          <a id="prodesclinktab" data-toggle="tab" href="#prodesctab">Description</a>
        </li> 

        <li @click="hideprophotoadd()">  
          <a id="prodaclinktab" data-toggle="tab" href="#prodactab">Dates and costs</a>
        </li>

        <!-- <li @click="showcomponent">   -->
        <!-- <li @click="hideprophotoadd()">  
          <a id="profilecodelinktab" data-toggle="tab" href="#profilecodetab">Profile Code</a>
        </li> -->

        <li @click="showprophotoadd()">  
          <a id="prophotolinktab" data-toggle="tab" href="#prophototab">Project Photo</a>
        </li>
      </ul>

      <div class="tab-content" style="border:1px solid #aeaeae; border-top:none;padding:4px;padding-top:0px;">

        <!-- <div id="degreetab" class="tab-pane fade in  active"> Dynamically load child component-->
        <div id="proteamtab" class="tab-pane fade in active ">
          <!-- <empdegreetabcontent v-if="showdegree"/> -->
          <!-- <empdegreetabcontent :is="current"></empdegreetabcontent> -->
          <!-- <empprojecttabcontent/> -->
          <!-- <proteamtabcontent/> -->
        </div>


        <!-- <div id="degreetab" class="tab-pane fade in  active"> Dynamically load child component-->
        <div id="prodesctab" class="tab-pane fade in ">
          <!-- <empdegreetabcontent v-if="showdegree"/> -->
          <!-- <empdegreetabcontent :is="current"></empdegreetabcontent> -->
          <!-- <prodesctabcontent/> -->
        </div>
        <!-- end degreetab div -->


        <div id="prodactab" class="tab-pane fade in " style="padding-top:7px;padding-bottom:2px;">
          <!-- <empregtabcontent v-if="showreg"/> Dynamically load child component-->
          <!-- https://stackoverflow.com/questions/48397597/dynamically-add-a-child-component-in-vue-js -->
          <!-- <empregtabcontent :is="current"></empregtabcontent> -->
          <!-- <prodactabcontent /> -->
        </div>


        <!-- <div id="profilecodetab" class="tab-pane fade in "> -->
          <!-- <empregtabcontent v-if="showreg"/> Dynamically load child component-->
          <!-- https://stackoverflow.com/questions/48397597/dynamically-add-a-child-component-in-vue-js -->
          <!-- <empregtabcontent :is="current"></empregtabcontent> -->
          <!-- <profilecodetabcontent />
        </div> -->

        <!-- :src="'images/empphoto/'+emp.ImageData" -->
        <!-- <div id="prophototab" class="tab-pane fade in">
          <div style="height:210px;">
              <prophototabcontent style="float:left"></prophototabcontent>
              <div style="margin-top:7px; margin-bottom:7px; margin-left:5px; background-color:blue;float:left">
                 <img
                  class="pull-left"
                  src='images/prophoto/1990-0238/big1.jpg'
                  style="height:200px;border:1px solid #b6b6b6;"
                  alt
                />
              </div>
          </div>
        </div> -->


        <a hidden id="btnprodacadd" @click="openprophotoaddmodal()" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer; color:#006fae;" ><i class="fa fa-plus" style="color:#006fae;"></i> Add New Photo</a>
<!-- style="width:100%;border:1px solid #b6b6b6;background:url('images/loader.gif');background-repeat:no-repeat;" -->
        <div id="prophototab" class="tab-pane fade in ">
           <div class="row">
              <div class="col-sm-8" style="padding-right:0px;">
                  <!-- <prophototabcontent ref="prophototabcontent" /> -->
              </div>
              <div class="col-sm-4" style="padding-top:7px;padding-left:5px;">
                <div  style="width:100%;min-height:240px;border:1px solid #aaaaaa;background:url('images/ajax-loader.gif');background-repeat:no-repeat;background-position: center;">
                  <img
                  id="test2"
                  :src="imagepath"
                  style="width:100%;"
                  alt
                />
                </div>
              </div>
           </div>
        </div>



        <!-- end regtab div -->

        <!--ref="editmodalcomponent" is used to call modal method from parent /> -->
        <proeditmodal ref="editmodalcomponent" v-bind:projectid="projectid" />
        <!-- global unauthorised message will also worl in tab contents dont need in tabcontents -->
        <!-- <globalunauthorisedmsg /> -->
        <!-- <globaldeletemsg /> -->


      </div>
      <!-- end Full tab-content class div -->
    </div>
    <!-- end tab container -->

    <!-- </div> end main container div -->

    <!-- get empid from emp.id put it in hidden p to pass to jquery -->
    <!-- <p id="hiddenempid" style="display: none">{{emp.id}}</p> -->

    
  </div>
</template>

<script>
import proteamtabcontent from "./prochild/proteamtabcontent.vue";
// import prodesctabcontent from "./prochild/prodesctabcontent.vue";
// import profilecodetabcontent from "./prochild/profilecodetabcontent.vue";
// import prophototabcontent from "./prochild/prophototabcontent.vue";
// import prodactabcontent from "./prochild/prodactabcontent.vue";
import proeditmodal from "./ProEditModal.vue";

// import empdegreeeditmodal from "./empdegreeeditmodal.vue";
// import axios from "axios";

export default {
  name: "prodetail",
  components: {
    proteamtabcontent, 
    // prodesctabcontent,
    // profilecodetabcontent,
    // prophototabcontent,
    // prodactabcontent,
    proeditmodal



  
     // https://stackoverflow.com/questions/48397597/dynamically-add-a-child-component-in-vue-js
      // show1: empdegreetabcontent,// used to  Dynamically load child component using :is
      // show2: empregtabcontent, // used to  Dynamically load child component using :is


  },
  data() {
    return {
      projectid: 0,
      cssclass:'active',
      // emp: {},
      project: {},
      lstProjectID: [],
      findid:0,
      // imagepath:'images/prophoto/null.jpg',
      imagepath:'',

      // showdegree:false, //used to  Dynamically load child component
      // showreg:false,   //used to  Dynamically load child component
    
      // current: 'show1' // used to  Dynamically load child component using :is


    };
  },

  // props: ["empid"],

    methods:{
      // parentMethod(){
      //      alert("prodetail");
      // },

      showprophotoadd(){
        $("#btnprodacadd").show();
      },
      hideprophotoadd(){
        $("#btnprodacadd").hide();
      },

      openprophotoaddmodal(){
        this.$refs.prophototabcontent.prophotoshowaddmodal();
      },

     findbyprojectno(){

      // this.findid=$("#projectno").val();
      this.findid=$("#selectprojectno").val();
      

      // to find detail page for emp but looses history and reloads entire page
      // this :key is used for fid by Employeeid in detail page to avoid whole page reload . This :key will
      // check for any change in route and remount the page without reloading. History is also preserved   -->
      // https://laracasts.com/discuss/channels/vue/vue-2-reload-component-when-same-route-is-requested?page=1 -->
      // this line is added in master.blade.php <router-view :key="$route.fullPath"></router-view>
      this.$router.push({
        name: "prodetail", // name property of this route must be used in route list to use with parameter
        params: { proid: this.findid},
        query:{this: this.findid} // query param is used to pass empid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
      });

 
      // this.$router.go(this.$router.currentRoute);
      //  var href="/empdetail?this=5"
      //  window.location.href = href;

      //  window.location = this.currentRoute;

      //  var evt = $.Event("keypress");
      //     evt.keyCode = 65;
      //     evt.ctrlKey = true;
      //     evt.shiftKey=true;
      //     $(document).trigger(evt); 


    },

    backtoproject(){

            this.$router.push('project');
    },


    showproeditmodal() {

      // // since the above cannot be used without latest laravel ver usertype is passed from master.blade in a hidden span 
      // // and used here as prototype to use in all pvue pages
      // var s1=this.$usertype;
      // var s2="admin";
      // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
      //   // alert("You don't have permission to run this operation");
      //   $("#globalunauthorisedmsg").modal("show");
      //   return;
      // } 


        //to get edit data from databese in child instead of table row
      this.projectid = this.project.ProjectID;//$("#prohiddenid").val();
      // console.log(this.projectid);
      this.$refs.editmodalcomponent.loadeditdata(this.projectid);

      $("#proeditmodal").modal("show");

    },


    proconfirmdelete(){

      var s1=this.$usertype;
      var s2="admin";
      if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
        // alert("You don't have permission to run this operation");
        $("#globalunauthorisedmsg").modal("show");
        return;
      }       

      $("#proconfirmdelete").modal("show");
      // $("#globaldeletemsg").modal("show");

    },


    deleteproject() {

       // this.projectid = $("#prohiddenid").val(); // this.projectid now set in mounted under table click
      this.projectid = this.project.ProjectID;

      this.$axios
        .delete(this.$host+"api/project/" + this.projectid + "").then(response => {

               toastr.success("Deleted item successfully.", "Success Alert", {
                  timeOut: 3000
               });

          // $('#projectTable').DataTable().ajax.reload(); // refresh parent table
          this.$router.push('project');
            
        })
        .catch(err => {
          console.log(err);

          // Display a warning toast, with no title
          toastr.error("Could not delete. "+err, "Alert", {
              timeOut: 3000
           });

        });
    },



    refreshprodetail(){
  
          this.$axios
          .get(this.$host+"api/project/prodetails/" + this.projectid + "").then(response => {
           
           this.project = response.data[0];
        
          // No Need now since changing the SecondaryProjectType data in the $post with formated SecondaryProjectType in controller
          // this.project = response.data.post[0];
          // this.project.SecondaryProjectType=response.data.post2; // to get the converted SecondaryProjectType string send from controller seperately


          })
          .catch(err => {
            iziToast.error({
                title: 'Error',
                message: 'Error loading project detail page',
              });
          }); 
        }



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

    }, // methods



  mounted() {


      $(document).ready(function () {

        // self.imagepath="images/prophoto/1990-0238/big1.jpg";
        // self.imagepath="images/prophoto/1990-0238/Photo1.jpg?"+Date.now();


        var table = $('#proPhotoTable').DataTable();
        // var rows = table.rows;
        // alert( 'Pupil name in the first row is: '+ rows[0]);


        $('#proPhotoTable').on( 'click', 'tr', function () {
          // $('#test2').after("<img src='images/ajax-loader.gif' alt='loading' style='position: relative;left: 150px;top:-180px;z-index: 9999;' />").fadeIn(); 
          //  $('#proPhotoTable').css("background","url('images/ajax-loader.gif')");   
          // self.imagepath="./../kseng/ksep/images/loader.gif";
          // self.imagepath="images/loader.gif";
// $('#test2').hide();

          if (table.data().count()>0) {
            var rowData = table.row( this ).data();
            // https://stackoverflow.com/questions/321865/how-to-clear-or-replace-a-cached-image
            // +"?"+Date.now() is used as query to avoid loading previous cached image after edit, since not using time in image name in controller to avoid duplicate image
            self.imagepath=""
            // self.imagepath="images/loader.gif";
            setTimeout(() => { // used timeout for web version to show loader.gif
                self.imagepath="images/prophoto/"+rowData.ImageData+"?"+Date.now();
                // $("#test2").attr("src","images/prophoto/"+rowData.ImageData)+"?"+Date.now();
            }, 20); // This promise will be resolved in 2000 milli-seconds

            if ( $(this).hasClass('selected') ) { // row highlight on select
                $(this).removeClass('selected');
                
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');


            }
          }
// $('#test2').show();

        });
        


      }); // End document ready




    // Refresh Promain after edit on modal hide
    // call vue data inside jquery ,no need for hidden element click for indirect call
    // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component
    var self=this; // using vue method in jquery in this way

    $('#proeditmodal').on('hidden.bs.modal', function () {
      self.refreshprodetail();
    })


    // access route parameter value use "this.$route.params.eid"
    this.projectid = this.$route.params.projectid;


    // get empid from global variable when page is refreshed since previous id is lost and becomes null with refreshed
    if (this.projectid==null) {
      // this.empid=this.$empdetailglobalvariable;
      //  this.$router.push('employee');
      this.projectid=this.$route.query.this;// query param is used to reset empid since empid is lost  when page is refreshed

    }
    // console.log(this.empid);

  

    // to show the photo of the first row of the table when table loads first time
    this.$axios
      .get(this.$host+"api/project/prophotogetimagedata/" + this.projectid + "").then(response => {
          if (response.data[0]) {
            this.imagepath="images/prophoto/"+response.data[0].ImageData+"?"+Date.now();
          }
      })
      .catch(err => {
          console.log(err);
      });


  
    this.$axios
      // .get("apiprodetaildata/" + this.projectid + "").then(response => {
        .get(this.$host+"api/project/prodetails/" + this.projectid + "").then(response => {

        // this.project = response.data[0];
        this.project = response.data;

        //  No Need now since changing the SecondaryProjectType data in the $post with formated SecondaryProjectType in controller
        // this.project = response.data[0];
        // now getting 2 data, one for the main project and the other for converted SecondaryProjectType to string
        // this can be done here in mounted() using js, but better to convert it on server controller
        // https://stackoverflow.com/questions/8373315/is-there-a-way-to-pass-multiple-arrays-to-php-json-encode-and-parse-it-with-jque
        // this.project = response.data.post[0];
        // this.project.SecondaryProjectType=response.data.post2; // to get the converted SecondaryProjectType string send from controller seperately


            // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'm/d/Y')
            // // to show hiredate in detail modal in mm/dd/yyyy format
            // if (this.project.created_at!=null) {
            //     let userDate = this.project.created_at;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
            //     this.project.created_at=date_string;
            // }
            // if (this.project.updated_at!=null) {
            //     let userDate = this.project.updated_at;//'1999-02-13 00:00:00';
            //     var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
            //     this.project.updated_at=date_string;
            // }


      })
      .catch(err => {
        console.log(err);
      });


    // set global variable with empid since when page is refreshed previous id is lost
    // used to get the empid from this variable when detail page is refreshed and previous id is lost
     
    // console.log(this.$empdetailglobalvariable);
    // console.log(this.$route.query.this)


   this.$axios
      // .get("apilstProjectID").then((response) => {
        .get(this.$host+"api/project/lstProjectID").then((response) => {
          this.lstProjectID = response.data
          $("#selectprojectno").selectpicker(); 

    }).catch((err) => {
          console.log(err)
    }); 


          // // To convert SecondaryProjectType id's to string
          // // this can be done here in mounted() using js, but better to convert it on server controller
          // axios.get("apilstProjectType").then((response) => {

          //     var resdata=response.data;
          //     var result="";
                
          //     if (this.project.SecondaryProjectType!=='') {
    
          //       var str = this.project.SecondaryProjectType;
          //       var strarray = str.split(",");

          //         for (let i = 0; i < strarray.length; i++) {
          //           var id1 = strarray[i];
                  
          //             for (let j = 0; j < resdata.length; j++) {
          //               var id2 = resdata[j].ListID;

          //                 if (id2==id1) {
          //                   result=result+","+resdata[j].Str1;
          //                 }
          //             }
          //         }

          //         result = result.substring(1); // remove the first ","
          //     }    

          //     //console.log(result)
          //     this.project.SecondaryProjectType=result;

          //     }).catch((err) => {
          //         console.log(err)
          //     });  


  // $('#proeditmodal').on('hidden.bs.modal', function () {
  // // $('#save').click(function () {
  //   $( "#refreshproject" ).trigger( "click" );
  // })



  }, // mounted



  
};
</script>




<style  >



/*di for detail view===================================================================== */

/* detail views label dt for all views */
#details dt {
  /* font-family: "Roboto", Arial, Helvetica, sans-serif; */
  font-family: "Helvetica", Arial, sans-serif;
  font-size: 13px !important ;
  letter-spacing: 0.1px;
  color: #161616;
   /* margin-right:-40px; */
}

/*to align thead dt labels left*/
.dl-horizontal dt {
  text-align: left;
}

#details dd, #details dt {
  line-height: 1.72857143;
/* font-family: "Roboto", Arial, Helvetica, sans-serif; */
  font-size: 13px;
}

/* .form-horizontal .control-label {
  text-align: left;
} */

.col-sm-2 {
  width: 10.6%;
}





/*TAB STYLES in detail view=============================================================== */

/*TAB Border color*/
#navtabs {
    border-bottom: 1px solid #aeaeae;
}

ul.nav.nav-tabs {
    margin: 0px 0px;
}

/*tab height*/
#navtabs.nav > li > a {
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











</style>

