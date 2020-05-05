<template>
  <div >

<!-- Start Confirm Delete Modal ********************************************* -->
    <div id="prophotoconfirmdelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom:5px;background-color:#f1f1f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Delete Confirmation</h3>
                </div>
                <div class="modal-body" style="padding:30px;">
                    Are you sure you want to delete the selected photo <span style="font-size:16px;"><b>'{{prophoto.PhotoName}}' </b></span> <br>
                    from photo list of project no.<span style="font-size:16px;"><b>'{{prophoto.ProjectNo}}' </b> </span>?<br>
                    <!-- All related data of the selected employee will also be deleted. -->
                </div>
                <div class="modal-footer">
                    <button @click="prophotodelete()" type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                    <button  type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>


<!-- Start Detail Modal ********************************************* -->
  <div class="modal fade" id="prophotodetailmodal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content " style=" width:600px">

        <div
          class="modal-header" style="background-color: #f1f1f1; border-radius: 5px 5px 0 0;  border-bottom: 1px solid lightgrey;  height: 52px; ">
          <button @click="modalclosed"  type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Photo Detail</h4>
        </div>

        <div class="modal-body" id="details" style="padding:30px;padding-top:20px; padding-bottom:0px;">
      
          <div class="row">

              <div class="col-sm-12">



                <dl class="dl-horizontal" style="margin-bottom:0px;">

                  <dt>Project No.</dt>
                  <dd id="ddProjectNo">{{prophoto.ProjectNo}}</dd>
                  <dt>Project Name</dt>
                  <dd id="ddProjectName">{{prophoto.ProjectName}}</dd>
                  <dt>Photo Name</dt>
                  <dd id="ddPhotoName">{{prophoto.PhotoName}}</dd>
                  <dt>Image Data</dt>
                  <dd id="ddImageData">{{prophoto.ImageData}}</dd>
                  <dt>Description</dt>
                  <dd id="ddDescription">{{prophoto.Description}}</dd>
                  <dt>Created by</dt>
                  <dd id="ddCreatedBy">{{prophoto.CreatedBy}}</dd>
                  <dt>Last modified by</dt>
                  <dd id="ddLastModifiedBy">{{prophoto.LastModifiedBy}}</dd>
                  <dt>Created at</dt>
                  <dd id="ddcreatedat">{{prophoto.created_at}}</dd>
                  <dt>Updated at</dt>
                  <dd id="ddupdatedat">{{prophoto.updated_at}}</dd>
                </dl>
                
              </div>

              <div class="col-sm-12">
                <!-- <div  style="width:100%;min-height:240px;border:1px solid #aaaaaa;background:url('images/loader.gif');background-repeat:no-repeat;background-size: 410px;"> -->
                <div  style=" margin-top:10px;width:100%;min-height:280px;border:1px solid #aaaaaa;background:url('images/ajax-loader.gif');background-repeat:no-repeat;background-position: center;">
                    <img
                    :src="this.$parent.imagepath"
                      width="100%"
                      alt
                    />
                </div>
              </div>

        </div>
        <!-- end row -->



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




<!-- Start Photo Link Modal ********************************************* -->
  <div class="modal fade" id="prophotolinkmodal" role="dialog">
    <div class="modal-dialog" style=" width:820px">
      <!-- Modal content-->
      <div class="modal-content">

        <div
          class="modal-header" style="background-color: #f1f1f1; border-radius: 5px 5px 0 0;  border-bottom: 1px solid lightgrey;  height: 52px; ">
          <button @click="modalclosed"  type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Photo -  {{prophoto.PhotoName}}</h4>
        </div>

        <div class="modal-body" id="details" style="padding:20px; padding-bottom:0px;padding-top:2px;">
      
          <div class="row">

              <!-- <div class="col-sm-12">
                <div  style="width:100%;min-height:240px;border:1px solid #aaaaaa;background:url('images/loader.gif');background-repeat:no-repeat;background-size: 410px;">
                  <img
                    :src="this.$parent.imagepath"
                    width="100%"
                    alt
                  />
                </div>
              </div> -->
              <!-- <button @click="previmage()" class="btn btn-default btn-sm pull-right" style="margin-left:5px;margin-right:15px;margin-bottom:5px;">previous</button>   
              <button @click="nextimage()" class="btn btn-default btn-sm pull-right">next</button>    -->
              <a @click="nextimage()" class="pull-right" style="margin-left:5px;margin-right:15px;margin-bottom:1px;margin-top:0px;cursor:pointer"> next</a>   
              <a @click="previmage()" class="pull-right" style="cursor:pointer;margin-bottom:1px;margin-top:0px;">previous | </a>                

              <div class="col-sm-12">



                <div style="width:100%;min-height:450px;border:1px solid #aaaaaa;background:url('images/ajax-loader.gif');background-repeat:no-repeat;background-position: center;">
                  <img
                    :src="this.$parent.imagepath"
                    width="100%"
                    alt
                  />
                </div>
              </div>

              <div class="col-sm-12">

                <dl class="dl-horizontal" style="padding-top:10px;margin-bottom:10px;">
                 <dt>Photo Name</dt>
                  <dd id="ddPhotoName" style="margin-left:150px">{{prophoto.PhotoName}}</dd>
                  <dt>Description</dt>
                  <dd id="ddDescription" style="margin-left:150px">{{prophoto.Description}}</dd>
                </dl>
                
              </div>



        </div>
        <!-- end row -->



      </div>
      <!--  end detail and modal body-->

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
  <div class="modal fade" id="prophotomodal" role="dialog">
    <div class="modal-dialog" style="width:650px">
      <!-- Modal content-->
      <div class="modal-content ">
        <div
          class="modal-header "
          style="background-color: #f1f1f1; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 52px; "
        >
          <button @click="modalclosed" type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">Edit Project Team</h4> -->
           <h4 class="modal-title" v-if="addmode">Add Project Photo</h4>
           <h4 class="modal-title" v-else>Edit Project Project</h4>
        </div>

        <!-- form in place of modal body div -->
        <!-- <form method="post" class="modal-body" enctype="multipart/form-data" v-on:submit.prevent="updateItem"> -->

        <form
          class="form-horizontal"
          enctype="multipart/form-data"
          v-on:submit.prevent="addupdateItem"
          style="padding:0px;"
          id="prophotoform"
        >


        <!-- VALIDATION ERROR: on top of form. validation error(422 (Unprocessable Entity)) -->
        <div 
            id="prophototoperrbar"
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

              >Created by</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="CreatedBy"  id="CreatedBy" v-model="formdata.CreatedBy">
                  <option v-for="item in lstEmpID" :value="item.EmpID">{{ item.EmployeeID }}</option>
                </select>
               <div style="width:300px;"
                  v-if="formErrors['CreatedBy']"
                  class="error text-danger"
                 >{{ formErrors['EmpID'][0]}}
                </div>

              </div>
            </div>

             <div class="form-group">
              <label
                class="control-label col-sm-3"

              >Created by</label>
              <div class="col-sm-6">
                <select  type="select"  class="form-control" name="LastModifiedBy"  id="LastModifiedBy" v-model="formdata.LastModifiedBy">
                  <option v-for="item in lstEmpID" :value="item.EmpID">{{ item.EmployeeID }}</option>
                </select>
               <div style="width:300px;"
                  v-if="formErrors['LastModifiedBy']"
                  class="error text-danger"
                 >{{ formErrors['EmpID'][0]}}
                </div>

              </div>
            </div>




            <div class="form-group" >
              <label
                class="control-label col-sm-3"
               >Photo Name</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-6">
                <input
                  type="text"  class="form-control"  name="PhotoName"  id="PhotoName"  v-model="formdata.PhotoName"
                 />
               <div style="width:300px;"
                  v-if="formErrors['PhotoName']"
                  class="error text-danger"
                 >{{ formErrors['PhotoName'][0]}}
                </div>
              </div>
            </div>

            <div class="form-group" >
              <label
                class="control-label col-sm-3"
               >Image Data</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-6">
                <input
                  type="text"  class="form-control"  name="ImageData"  id="ImageData"  v-model="formdata.ImageData"
                 />
              </div>
            </div>


            <div class="form-group" >
              <label
                class="control-label col-sm-3"
               >Description</label>
              <!-- v-model="formdata.DegreeField" to bind to data  -->
              <div class="col-sm-6">
                <input
                  type="text"  class="form-control"  name="Description"  id="Description"  v-model="formdata.Description"
                 />
              </div>
            </div>



           <div class="form-group" >
              <label class="control-label col-sm-3">Select an image</label>
              
              <div class="col-sm-6" style="width:430px;" >
                 <!-- <img id="imageid" :src="'images/empphoto/'+ formdata.ImageData" alt="" style="width:50px;"> -->
                 <!-- <img  id="imageid" 
                    :src="dynamicimagepath" 
                    alt="" 
                    style="width:350px; border:1px solid #aaaaaa; margin-top:10px;margin-bottom:10px;" 
                  > -->
               

                  <div style="width:100%;min-height:220px;margin-top:10px;margin-bottom:10px;border:1px solid #aaaaaa;background:url('images/ajax-loader.gif');background-repeat:no-repeat;background-position: center;">
                      <img
                      :src="dynamicimagepath"
                        width="100%"
                        alt
                      />
                  </div>


                  <!-- image size validation -->
                  <div style="width:300px;"
                    v-if="formErrors['Image']"
                    class="error text-danger"
                  >{{ formErrors['Image'][0]}}
                  </div> 

                 <!-- <input type="file" style="padding-left:0; height: 20" name="ImageData"  id="ImageData" v-on:change="onFileChange">   -->
                <!-- <input type="file" style="padding-left:0; height: 20" name="ImageData"  id="ImageData" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> -->
                <input type="file" accept="image/*" style="display:none; padding-left:0; height: 20;" ref="fileInput" name="Image"  id="ImageData" v-on:change="onFileChange">  
                
               
                
                
                
                <!--  customising input btn https://www.youtube.com/watch?v=VqnJwh6E9ak -->  
                <div class="row">
                  <div class="col-sm-5">
                    <button class="btn btn-default btn-sm" @click.prevent="$refs.fileInput.click()" >Choose File</button>
                  </div>
                  <div class="col-sm-5">
                    <button class="btn btn-default btn-sm" style="margin-left:-85px;" @click.prevent="removeImage">Remove Image</button>
                  </div>
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
   <!-- <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;"> For view only</a> -->
   <!-- now in prodetail since table have part width -->
   <!-- <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer; color:#006fae;" v-on:click="prophotoshowaddmodal"><i class="fa fa-plus" style="color:#006fae;"></i> Add New</a> -->

    <!-- <table id="empdegreeTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
    <table id="proPhotoTable" class="table table-striped table-bordered" style="width:100%">
        <thead >
            <tr>
                <th hidden="hidden">
                    ProjectID
                </th>
                <th hidden="hidden">
                    ID
                </th>
                <th>
                    PhotoName
                </th>
                <th>
                    ImageData
                </th>
                <th>
                    CreatedBy
                </th>
                <th>
                    LastModifiedBy
                </th>
    
                <th>
                    Description
                </th>
                <!-- <th hidden="hidden">
                    ID
                </th> -->
                <th style="width:100px;">Action</th>
    
    
            </tr>
        </thead>
   
    </table>

<!-- this will store the empid on datatable row click -->
    <!-- <input type="text"  id="projecthiddenid"  hidden/> 
    <h1 id="projecthiddenopendetailpage" @click="openprojectdetailpage()" hidden>hiddenopendetailpage</h1> -->


    <!-- when mounted projectid is saved from route using "var proid=this.$route.query.this;" -->
    <!-- this projectid is used to fill datatable on load -->
    <!-- <p id="prophotohiddenprojectid" style="display: none">{{projectid}}</p> -->


    <input type="text"  id="prophotohiddenempid"  hidden/><!-- hyperlink employee detail page will store empid-->
    <!-- <h1 id="prophotohiddenopenemployeepage" @click="openemployeedetailpage()" hidden>hiddenopendetailpage</h1>    -->


    <!-- this is the ID col value of Pro_Team table received from row click and used to view detail of protean row -->
    <input type="text"  id="prophotohiddenid"  hidden/>
    <!-- <h1 id="prophotohiddenopendetailpage" @click="prophotoopendetailpage()" hidden>hiddenopendetailpage</h1>    
    <h1 id="prophotohiddenshoweditmodal" @click="prophotoshoweditmodal()" hidden>hiddenshoweditmodal</h1>  
    <h1 id="prophotohiddendelete" @click="prophotodelete()" hidden>hiddendeleteprophoto</h1>   -->

    <!-- this is used for clicking outside of modal which cannot be catched by modal buttons close event. so fired by jquery -->
    <!-- <h1 id="prophotohiddenmodalonhide" @click="modalonhide()" hidden>hiddenmodalonhide</h1> -->
<!-- <globaldeletemsgchild /> -->
  </div>
</template>


<script>
export default {
  name: "prophototabcontent",
  components: {
    // empcolselector,
    // empeditmodal
  },
  data() {
    return {

      projectid:0, // this is ProjectID col value of Pro_Team table
      id: 0,    // this is ID col value of Pro_Team table
      
      
      lstEmpID:[],  

      formErrors: {},
    // formErrorsUpdate: {},

    //GENERAL ERROR: Test if any error other than validation error(422 (Unprocessable Entity))
      // errstatus:false, //test
      // errstatusttext:'', //test   

      formdata: {
          PhotoName:'', 
          ImageData:'',
          CreatedBy:0, 
          LastModifiedBy:0, 
          Description:'', 
          ProjectID:0,
          ID:0,
          Image:{}, // extra field not in db for saving photofile in folder
          ProjectNo:'' // extra field not in db to use for photo path for field ImageData
      } ,

      prophoto:{},

      imagedatalist:[], // used for photo gallery next prev filled on mounted
      rowindex:0,

      image: {},

      //dynamic image path. Needed because img src is binded with formdata and has a path. 
      //so when user pick another image he cannot immidiately see the image since it it not stored in the path yet
      //to solve this dynamicimagepath is used
      dynamicimagepath: '', 
      

      addmode:true, // to switch between updateitem and additem 


    };
  },

  methods:{

    nextimage(){
        // to show the photo of the first row of the table after any delete if any row is present after delete
        // console.log((this.rowindex+1)+":"+this.imagedatalist.length)

        if (this.rowindex+1===this.imagedatalist.length) {
          return; // exit if end of row
        }

        if (this.imagedatalist.length>this.rowindex+1) {
            this.rowindex=this.rowindex+1
        }

        if (this.imagedatalist.length>this.rowindex) {
            this.$parent.imagepath=""
            setTimeout(() => { // used timeout for web version to show loader.gif
                this.$parent.imagepath="images/prophoto/"+ this.imagedatalist[this.rowindex].ImageData +"?"+Date.now();
            }, 20);
            
          // console.log(this.rowindex);
        }
    },

    previmage(){
        if (this.rowindex>0) {
            this.$parent.imagepath=""
            setTimeout(() => { // used timeout for web version to show loader.gif
              this.$parent.imagepath="images/prophoto/"+ this.imagedatalist[this.rowindex-1].ImageData +"?"+Date.now();
              this.rowindex=this.rowindex-1
            }, 20);

            // console.log(this.rowindex);
        }
    },



    // image related **********************************
    // https://codepen.io/Atinux/pen/qOvawK/
    onFileChange(e){
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.createImage(files[0]);
        
        var fileData =  event.target.files[0];
        this.image  = fileData;
        this.formdata.Image= event.target.files[0]; // save the image to formdata

    },

    createImage(file) {
        var image = new Image();
        var reader = new FileReader();
        // var vm = this;

        reader.onload = (e) => {
          // vm.image = e.target.result;
          this.image=e.target.result;
          this.dynamicimagepath=e.target.result;
        };
        reader.readAsDataURL(file);
    },
    removeImage: function (e) {

        this.image = '';
        this.formdata.Image = ''; // Added for addmode
        // this.imagefilename='';
        this.formdata.ImageData = '';
        this.dynamicimagepath="";
        $("#ImageData").val(''); // to remove file name from file input
    },
   // END image related ******************************





    modalclosed(){
        this.formErrors="";
        //  this.errstatus=false;
        //  this.errstatusttext=''; 
        //  $("#prophototoperrbar").hide();  
        $("#prophototoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition  
         this.addmode=true;         
    },

      // this is for clicking outside of modal which cannot be catched by modal buttons close event
    modalonhide(){
         this.formErrors="";
          
         this.addmode=true; 
      //  $("#prophototoperrbar").hide();         
         $("#prophototoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition
    },
      
    clearaddform(){
      // ** Should clear formdata since it could be populated with previous edit data

        this.formdata.PhotoName='', 
        this.formdata.ImageData='',
        this.formdata.CreatedBy=0; 
        this.formdata.LastModifiedBy=0;
        this.formdata.Description='', 
        this.formdata.ProjectID=0;
        this.formdata.ID=0;

        //  this.errstatus=false;
        //  this.errstatusttext='';   

        this.image = '';
        this.formdata.Image = ''; // extra field not in db for saving photofile in folder
        this.formdata.ImageData = '';
        // this.imagefilename='';
        this.dynamicimagepath=''; // must clear the dynamicimagepath too        
        // this.imagefilename='';
        $("#ImageData").val(''); // to remove file name from file input


        this.formErrors="";
        // $("#prophototoperrbar").hide();
        $("#prophototoperrbar").css("height", '0px');  // 0 height to hide the errbar for next css transition
         
         this.addmode=true; // must set to true here for extra safety(since modal can hide by clicking outside of modal)

    },

    //   // Hyperlink click EmployeeID
    // openemployeedetailpage(){

    //         // this.empid = $("#prophotohiddenempid").val();

    //         // code to open empdetail page router view by passing the empid value
    //         // this.$router.push('empdetail', {params: { empid: 5}})

    //         //  this.$router.push('empdetail')
    //         this.$router.push({
    //           name: "empdetail", // name property of this route must be used in route list to use with parameter
    //           params: { empid: this.empid },
    //           query:{this: this.empid} // query param is used to pass empid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
    //         });

    // },


      // View click
    prophotoopendetailpage(){
        // this.id = $("#prophotohiddenid").val();
        axios
        .get("apiprophotodetaildata/" + this.id + "").then(response => {
            this.prophoto = response.data[0];
        })
        .catch(err => {
            console.log(err);
        });

        $("#prophotodetailmodal").modal("show");
     },



    // Photo link click
    prophotoopenlink(){
      axios
        .get("apiprophotodetaildata/" + this.id + "").then(response => {
            this.prophoto = response.data[0];
        })
        .catch(err => {
            console.log(err);
        });
        
        $("#prophotolinkmodal").modal("show");
    },


    // Add click
    prophotoshowaddmodal(){

        // var s1=this.$usertype;
        // var s2="admin";
        // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
        //   // alert("You don't have permission to run this operation");
        //   $("#globalunauthorisedmsg").modal("show");
        //   return;
        // } 
    
    
        $('#prophotoform').trigger("reset");
        // $('#empform')[0].reset();
        this.clearaddform();  
        this.formdata.ProjectID=this.projectid;// set the mastertable empid for the child table degree    
        $("#prophotomodal").modal("show");
    },



     // Edit click
      prophotoshoweditmodal(){


            // var s1=this.$usertype;
            // var s2="admin";
            // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
            // // alert("You don't have permission to run this operation");
            // $("#globalunauthorisedmsg").modal("show");
            // return;
            // }  


            // this.image = '';
            // this.imagefilename='';

            // Turn this 2 lines off for pro-photo
            $("#ImageData").val(''); // to remove file name from file input
            this.dynamicimagepath=''; // must clear the dynamicimagepath too           


            this.addmode=false

            // this.id = $("#prophotohiddenid").val();

        axios
            .get("apiprophotoeditdata/" + this.id + "").then(response => {
            this.formdata = response.data[0];

            // load the image from the path and this.formdata.ImageData 
            // this.dynamicimagepath="images/prophoto/"+ this.formdata.ImageData;
            // https://stackoverflow.com/questions/321865/how-to-clear-or-replace-a-cached-image
            // +"?"+Date.now() is used as query to avoid loading previous cached image after edit, since not using time in image name in controller to avoid duplicate image
            this.dynamicimagepath= "images/prophoto/"+this.formdata.ImageData +"?"+Date.now();

            })
            .catch(err => {
            console.log(err);
            });

            //   alert("Degree Edit form: "+ this.id);
            $("#prophotomodal").modal("show");           
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
              apiurl="apiprophotoadddata/";
          } else {
              apiurl="apiprophotoupdatedata/";
          }


          // **IMPORTANT: files cannot be uloaded Without using FormData(js class)
          // var form = $("#empform").get(0); // get the form to pass into formData constructor 
          var fd = new FormData();

          fd.append("PhotoName", this.formdata.PhotoName);
          fd.append("ProjectID", this.formdata.ProjectID);
          fd.append("ID", this.formdata.ID);

          //  Foreign key is used in main table for List items col which has to set to null(instead of 0) 
          //  ONDELETE(when a list item row id deleted) as per mysql. 
          //  But null cannot be inserted in int field so 0 is set here
          //  In Employee FormData is used instead of this.formdata for Image. But FormData sends null as string 'null'
          //  So for Employee where FormData is used null value has to be converted to '' before sending to controller
          //  Sending a value of '' will store NULL in the field if default value for the field is NULL
          if (this.formdata.CreatedBy==null) {this.formdata.CreatedBy='';} 
          if (this.formdata.LastModifiedBy==null) {this.formdata.LastModifiedBy='';} 
          if (this.formdata.ImageData==null) {this.formdata.ImageData='';} 
          if (this.formdata.Description==null) {this.formdata.Description='';} 

          fd.append("CreatedBy", this.formdata.CreatedBy);
          fd.append("LastModifiedBy", this.formdata.LastModifiedBy);
          fd.append("ImageData", this.formdata.ImageData);
          fd.append("Description", this.formdata.Description);

          // extra field needed for photo path not in db table, get ProjectNo val from parent using $parent
          fd.append('ProjectNo', this.$parent.project.ProjectNo); 

          // var imagename = $("#EmployeeID").val() + ".jpg";
          // var fileInput = this.formdata.Image;//document.getElementById("ImageData").files[0];
          var fileInput = this.formdata.Image;
          


          // if ($("#ImageData").val()!="") {
          if (this.formdata.Image!=="null") {
            // formData.append('Image', fileInput, imagename);
            fd.append('Image', fileInput);
          }


            // axios.post(apiurl, this.formdata).then(response => {
             axios.post(apiurl, fd).then(response => {

              //  alert(response.data);
              //  return;

                  $("#prophotomodal").modal("hide");

                  toastr.success("Item Updated Successfully.", "Success Alert", {
                    timeOut: 3000
                  });

                  $('#proPhotoTable').DataTable().ajax.reload(); // refresh parent table
                  this.addmode=true; //now done in onmodalhide(), still used here



                // // to show the photo of the first row of the table after any edit
                // axios
                // .get("apiprophotogetimagedata/" + this.projectid + "").then(response => {
                //     // this.prophoto = response.data[0];
                //     if (response.data[0]) {
                //       // console.log( response.data[0].ImageData);
                //       this.$parent.imagepath="images/prophoto/"+response.data[0].ImageData+"?"+Date.now();
                //     }
                // })
                // .catch(err => {
                //     console.log(err);
                // });


                // Now getting imagedata of the edited row from controller return data to show the edited image
                // $("#test2").attr("src","images/prophoto/"+response.data+"?"+Date.now());
                this.$parent.imagepath="images/prophoto/"+response.data+"?"+Date.now();

 

                })
              .catch((err) => {
                  console.log(err)

                  //axios Network Error doesnt have err.response.status, so used seperate condition
                   if (err.message==="Network Error") {
                        $("#prophotomodal").modal("hide");
                        toastr.error("Could not Save. "+ err.message, "Alert", {
                            timeOut: 5000 //3000
                        });
                        return;
                    }                    

                   if (err.response.status===422) { 
                        this.formErrors = err.response.data; // validation error(422 (Unprocessable Entity))
                        var totalerr=Object.keys(this.formErrors).length //count the number of properties(errors) in a JavaScript object
                        var height=30+(totalerr*20);

                        // Now using css transition instead of jquery to slide uo and down added in master.blade
                        $("#prophototoperrbar").css("height", height+'px');  
                        // $('#prophototoperrbar').show();
                        return;
                    } 

                    // GENERAL ERROR: Test  if any error other than validation error(422 (Unprocessable Entity) or Network)
                    $("#prophotomodal").modal("hide");
                        toastr.error("Could not Save. "+ err.response.statusText + " : "+ err.message, "Alert", {
                        timeOut: 5000 //3000
                    });  

              }); // end catch  

      },



      // Delete confirm msg
      prophotoconfirmdelete(){
          var s1=this.$usertype;
          var s2="admin";
          if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
                // alert("You don't have permission to run this operation");
                $("#globalunauthorisedmsg").modal("show");
                return;
          } 


          // to show employeeid and projectno in delete msg since prophoto is not populated yet
          axios
            .get("apiprophotodetaildata/" + this.id + "").then(response => {
                this.prophoto = response.data[0];
          })
            .catch(err => {
                console.log(err);
          });         

          $("#prophotoconfirmdelete").modal("show");
      },



      // Delete method
      prophotodelete(){


      //  var confirmdelete = confirm("Are you you want to delete the item?");
      //   if (confirmdelete ==false) {
      //   return;
      // }
           
            // this.id = $("#prophotohiddenid").val(); // this.id now set in mounted under table click

          axios
            .post("apiprophotodeletedata/" + this.id + "").then(response => {

                toastr.success("Deleted item successfully.", "Success Alert", {
                    timeOut: 3000
                    });
                $('#proPhotoTable').DataTable().ajax.reload(); // refresh parent table



                // to show the photo of the first row of the table after any delete if any row is present after delete
                axios
                .get("apiprophotogetimagedata/" + this.projectid + "").then(response => {
                    // this.prophoto = response.data[0];
                    if (response.data[0]) {
                      // console.log( response.data[0].ImageData);
                      this.$parent.imagepath="images/prophoto/"+response.data[0].ImageData+"?"+Date.now();
                    }
                    else{
                      this.$parent.imagepath="images/prophoto/null.jpg";
                    }
                })
                .catch(err => {
                    console.log(err);
                });





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

      $("#proPhotoTable").on("click", "#prophotoview", function(){
          self.id=$("#prophotohiddenid").val();
          self.prophotoopendetailpage();
      });
      $("#proPhotoTable").on("click", "#prophotolink", function(){
          self.id=$("#prophotohiddenid").val();
          // alert($(this).closest('td').parent()[0].sectionRowIndex);
          var rowindex=$(this).closest('td').parent()[0].sectionRowIndex;
          self.rowindex=rowindex; // get the rowindex to use it in rowindex for photogallery next prev
          self.prophotoopenlink();
      });
      $("#proPhotoTable").on("click", "#prophotoedit", function(){
          self.id=$("#prophotohiddenid").val();
          self.prophotoshoweditmodal();
      });
      $("#proPhotoTable").on("click", "#prophotodelete", function(){
          self.id=$("#prophotohiddenid").val();
          // self.prophotodelete();
          self.prophotoconfirmdelete();
          // $("#globaldeletemsgchild").modal("show");
      });

      // $("#proPhotoTable").on("click", "#prophotoempdetailpage", function(){
      //     self.empid=$("#prophotohiddenempid").val();
      //     self.openemployeedetailpage();
      // });

        // if clicked outside of bootstrap modal it hides and cannot catch this event with vue
        // so indiretcly catching this event by vue event "modalonhide" which will fire with a hidden btn click
        // called from this jquery modal hide function  
        $('#prophotomodal').on('hidden.bs.modal', function () {
          // $('#prophotohiddenmodalonhide').click();
          self.modalonhide();
        });     


        // $('#proPhotoTable tbody tr').on( 'click', 'tr', function () {
        //     alert( table.row( this ).data() );
        // });



        var token=this.$apitoken;// for api protection api_token is saved globally in app.js and use here
        var baseurldt=this.$baseURLdt;

        // get the id from query parameter to store it in data empid, it is then used in <p>hiddenempid</p>
        // then get the value from the hiddenempid using "var eid=$('#hiddenempid').html();" to use it in datatable parameter
        var proid=this.$route.query.this;
        this.projectid=proid;


        // fill image datalist to use for photogallery next prev
        axios
          .get("apiprophotogetimagedata/" + this.projectid + "").then(response => {
            this.imagedatalist=response.data; 
            console.log(this.imagedatalist);
          })
          .catch(err => {
              console.log(err);
          }); 



        $(document).ready(function () {





            // $("#proPhotoTable").on("click", "tr", function(){
            //     var rowData = table.row( this ).data();
            //     alert(rowData.ID);
            //     self.id=rowData.ID;
            // });

// $('#proPhotoTable tbody tr').on( 'click', 'tr', function () {
//      alert( table.row( this ).data() );
//    } );

        // var proid=$('#prophotohiddenprojectid').html();
        var proid=self.projectid;
        
      // delay loading of tab data which are not default
      // setTimeout(() => {

                //NO SERVERSIDE PROCESSING
               var table = $('#proPhotoTable').DataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    // select:true,
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
                        // "url": "/api/apiprophotodata/",// passing empid through POST request to api
                        url: baseurldt+"apiprophotodata",
                        headers: {
                          // Laravel token based api authentication this is retrieved from users/api_token field and added "Bearer " space after
                          // for api protection api_token is saved globally in app.js and use here
                          'Authorization' : token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
                        },
                        "type": "POST",
                        "datatype": "json",
                        "dataSrc": '', // dont use for server side processing

                        // passing proid through GET request to api    
                        "data": {
                            "ProjectID": proid
                        },
        
                    },

                    "columns": [ 
                      { "data": "ProjectID", "visible": false },
                      { "data": "ID", "visible": false },
                      { "data": "PhotoName",

                        render: function(data, type, row) {
                            // return ( "<a  onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddenopendetailpage').click(); style='cursor:pointer'>"+data +"</a>")
                            return ( "<a  onclick=$('#prophotohiddenid').val("+row.ID +"); id='prophotolink' style='cursor:pointer'>"+data +"</a>")
                            }
                      
                      },
                      { "data": "ImageData" },
                      { "data": "CreatedBy", "visible": false},
                      { "data": "LastModifiedBy", "visible": false},
                      { "data": "Description"},
                      // // to limit the string. https://stackoverflow.com/questions/31809932/datatable-cell-string-truncate
                      // { "data": "EmployeeID","mRender": function(data, type, row) {
                      //     if(data.length > 70){
                      //         var trimmedString = data.substring(0, 70);
                      //         // trimmedString + '...';
                      //       return   "<a onclick=$('#prophotohiddenempid').val("+row.EmpID +"); id='prophotoempdetailpage' style='cursor:pointer;color: #006fae'>"+ trimmedString + '...' +"</a>"
                      //     } else {
                      //         return "<a onclick=$('#prophotohiddenempid').val("+row.EmpID +"); id='prophotoempdetailpage' style='cursor:pointer;color: #006fae'>"+ data +"</a>";
                      //      }
                      // }},

                        { "data": "ID", "render": function (data, type, row) {
                                // ** with inline jquery no need to call function from outside vue(masterpage)
                                return(    
                                    "<a onclick=$('#prophotohiddenid').val("+row.ID +"); id='prophotoview' style='cursor:pointer'>View</a> | <a onclick=$('#prophotohiddenid').val("+row.ID +");  id='prophotoedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#prophotohiddenid').val("+row.ID +");  id='prophotodelete' style='cursor:pointer'>Delete</a>"
                                );
                             },
                         } // end col ID
                       

                    ] // end columns
        
        
                });//end var table

// }, 2000) 






    }) // End document ready




    setTimeout(() => {

      // now receiving all combo in one request under a group
      // ***********************************************************************

            axios.get("apiprophotocombogroup").then((response) => {
                  this.lstEmpID = response.data.Emp_Main;

              }).catch((err) => {
                  console.log(err)
              });  


    }, 200); // This promise will be resolved in 2000 milli-seconds






  }, // end mounted



};
// proPhotoTable

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

#prophotodetailmodal dt,#prophotodetailmodal dd
 {
  font-family: "Helvetica", Arial, sans-serif;
  line-height: 1.72857143;
   /* line-height: 2.0; */
/* font-family: "Roboto", Arial, Helvetica, sans-serif; */
  font-size: 13px;
  
}
#prophotodetailmodal dd{
  margin-left:160px;
}

#details dt {
  color: #333;
}





/* search combo styles************************************ */
#prophotoform .form-group{
  margin-bottom: 5px;
}
#prophotomodal .control-label{
    padding-left: 0px;
    text-align: left;
    margin-bottom: 0px;
    font-size: 13px;
    color:black;

    /* style="margin-right:0px;padding-left:30px;text-align:left;font-size: 13px; color:black;" */
}
#prophotoform select[type="select"] {
   height: 30px;
   /* width:350px; */
   border-radius: 2px;
   color:#333;
}
#prophotoform input[type="date"] {
   height: 30px;
   /* width:350px; */
   border-radius: 2px;
   color:#333;
}
#prophotoform input[type="text"] {
   height: 30px;
   /* width:350px; */
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
