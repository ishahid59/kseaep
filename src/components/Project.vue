<template>
  <div>
    <h1>Projects</h1>
    <h1>{{anyRemaining}}</h1>
  </div>
</template>


<script>

export default{
   computed:{
    anyRemaining(){
      //this.$store.state.test = "CHANGED";
      return this.$store.getters.getTest;
    }
  },
  mounted() {
    if(localStorage.getItem('token')==""){
      this.$router.push({ name: "login" });
    }
  }
}

</script>