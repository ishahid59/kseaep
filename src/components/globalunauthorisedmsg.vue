<template>

    <div id="globalunauthorisedmsg" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom:0px;background-color:#f1f1f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title"  style="color:#c81313;">Permission required</h2>
                </div>
                <div class="modal-body" style="padding:30px; font-size:15px;">
                    You don't have permission to perform this action. <br>
                    Permission is required from administrator for this operation.
                </div>
                <div class="modal-footer">
                      <button  type="button" data-dismiss="modal" class="btn btn-primary" style="width:80px;">OK</button>
                </div>
            </div>
        </div>
    </div>
<!-- End columnSelectorModalModal ==================================================-->

</template>

<script>

export default {
  name: "globaldeletemsg",
    methods:{
        // call a parent method using $parent
        // https://stackoverflow.com/questions/46208610/call-parent-method-with-component
        someMethod(){
        this.$parent.parentMethod();
   },

}
}


</script>



<style >

</style>