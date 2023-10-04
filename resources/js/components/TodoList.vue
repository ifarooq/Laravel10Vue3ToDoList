<template>
   <div class="container mt-5">
  <h2>Add Item in To Do List</h2>
  <form id="contactForm">


    <div class="input-group mb-3">
  <input ref="itemref" required v-model="form.title" type="text" class="form-control" placeholder="Enter Item" aria-label="Enter Item" aria-describedby="button-addon2" @keyup.enter="onSubmit" tabindex="0">
  <button class="btn  btn-primary" type="button" id="button-addon2" v-on:click="onSubmit"> <span v-if="form.id">   Update </span> <span v-else>   +Add </span>   </button>
</div>


  </form>



    <div class="container mt-5">
  <h2>Todo List</h2>


    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" v-model="display_status" name="display_status" id="inlineRadio1" value="2">
  <label class="form-check-label" for="inlineRadio1">Show All</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio"  v-model="display_status" name="display_status" id="inlineRadio2" value="1">
  <label class="form-check-label" for="inlineRadio2">Show Completed</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio"  v-model="display_status" name="display_status" id="inlineRadio3" value="0" >
  <label class="form-check-label" for="inlineRadio3">Show In Complete</label>
</div>


  <ul class="list-group">
    <li v-for="todo in todo_lists" class="list-group-item todo-item" :key="todo.id"  :class="{ completed: todo.status}">
        {{todo.title}}
      <div>  <button class="btn btn-primary btn-sm me-2" v-on:click="onEdit(todo.id)">Edit</button>
        <button class="btn btn-danger btn-sm me-2" v-on:click="deleteTodo(todo.id)">Delete</button>
        <button :class="{ 'btn-success': todo.status, 'btn-warning':!todo.status}" class="btn btn-success btn-sm" v-on:click="updateStatus(todo.id)"> <span v-if="todo.status"> Mark Complete </span>  <span v-else> Mark In Complete </span> </button>
      </div>
    </li>

  </ul>
</div>


</div>





</template>
<style scoped>

 li.completed{

    text-decoration: line-through;

 }

 .todo-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #dee2e6;
      border-radius: 5px;
    }

</style>
<script>
   export default {
  /*   props: ['title','description'], */
   /* ready: function() {
       alert("hi...");
    },*/
   data: () => ({
    loading:false,
    loading_text:'Loading...',
    todo_lists:[],
    display_status:'2',
    form:{
        id:'',
        title:'',
        status:'',




    },
     notices_data:[],
     notices:[],

    }),
    mounted:function() {

     this.fetchTodos();

  },
    methods: {

        deleteTodo:function(id){

        axios.delete('/todo-list/'+id)
.then(response => {

    //alert('deleted');
    this.fetchTodos();

 })
.catch(error => {
    console.log(error);

});

        },

        onSubmit:function(){

            if(this.form.title==''||this.form.title=='null'){


                alert('Title is requird');
                return false;
            }


            let formData = new FormData();

              formData = this.form;
              this.loading=true;
   this.loading_text='Sending email please wait!';

   if(this.form.id!=''&&this.form.id!='null'){

    axios.put('/todo-list/'+this.form.id, formData)
      .then(response => {
       // alert(response.data.result.name);
       this.loading=false;
       this.loading_text='Loading....';

    this.form.title=''
        this.form.status=''
        this.form.id='';
     this.fetchTodos();

      })
      .catch(error => {
        console.log(error);

    });



   }else{

   axios.post('/todo-list', formData) // Send a POST request to the backend API with the form data
      .then(response => {
       // alert(response.data.result.name);
       this.loading=false;
       this.loading_text='Loading....';
       this.form.title=''
        this.form.status=''
        this.form.id='';
     this.fetchTodos();

      })
      .catch(error => {
        console.log(error);
      });

    }

    this.$refs.item.focus();

        },

        fetchTodos:function(){


  this.loading=true;
this.loading_text='Loading data...!';
axios.get('/todo-list/fetch-all?status='+this.display_status) // Send a POST request to the backend API with the form data
.then(response => {
// alert(response.data.result.name);
this.loading=false;
this.loading_text='Loading....';
 this.todo_lists=response.data;

})
.catch(error => {
 console.log(error);
});



},

updateStatus:function(id){


this.loading=true;
this.loading_text='Loading data...!';
axios.get('/todo-list/update-status/'+id) // Send a POST request to the backend API with the form data
.then(response => {
// alert(response.data.result.name);
this.loading=false;
this.loading_text='Loading....';
this.fetchTodos();

console.log(error);
})
.catch(error => {
    console.log(error);
});



},


onEdit(id){


           this.loading=true;
           this.add_update_form=true;

            this.loading = true;
             axios.get('/todo-list/'+id+'/edit/')
                 .then(response => {


                     this.form.title=response.data.title;
                     this.form.id=response.data.id;

                      this.loading = false;



               }).catch((error) => {

                console.log(error);

   });


       },





 }

 ,

watch:{

    'display_status':function(){

     this.fetchTodos();

    }




}





    }

</script>
