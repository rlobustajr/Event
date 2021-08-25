<template>
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Registration Form -->
                            <div class="row" v-show="form.registration">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6" style="height:500px">
                                    <b-container fluid class="mt-5">
                                        <b-form-group>
                                            <h1 class="text-center mt-3 mb-3">CALENDAR EVENT</h1>
                                            <p class="text-center">
                                            Events are items that you'd like to put on your calendar that will in no way be tied to a priority.
                                            </p>
                                            <hr class="my-5">

                                            <p>
                                            WHAT'S YOUR NAME?
                                            </p>

                                            <!--USER NAME-->
                                            <b-form-input v-model="user.name" class="text-center" size="lg" placeholder="INPUT YOUR NAME HERE" style="text-transform:uppercase" trim></b-form-input>

                                            <!--START BUTTON-->
                                            <b-button variant="success" size="lg" class="mt-3 w3-right" @click="formShow('event')">Start now!</b-button>
                                        </b-form-group>
                                    </b-container>
                                </div>
                            </div>
                            <!-- Registration Form -->
                            <!-- Event Form -->
                            <div class="row" v-show="form.event">
                                <div class="col-lg-6" style="height:500px">
                                    <b-container fluid class="mt-3">
                                        <b-form-group>
                                            <h1 class="mb-3">Hi {{this.user.name}}!</h1>
                                            <hr class="my-2">

                                            <b-card class="text-left mt-3 mb-3">
                                                <template v-slot:header>
                                                    <h6 class="mb-0"><b>Event Details</b></h6>
                                                </template>

                                                <!--EVENT DETAILS-->
                                                <b-row class="mt-3 mb-2">
                                                    <b-col md="12">
                                                        <b-form-group label-align-sm="right" label-cols-sm="4" label-cols-lg="3" label="Event Name :">
                                                            <b-form-input v-model="user.event_name" required placeholder="Input Event Name"></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                                <b-row class="mt-3 mb-2">
                                                    <b-col md="12">
                                                        <b-form-group label-align-sm="right" label-cols-sm="4" label-cols-lg="3" label="From:">
                                                            <b-form-datepicker v-model="user.from"></b-form-datepicker>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                                <b-row class="mt-3 mb-2">
                                                    <b-col md="12">
                                                        <b-form-group label-align-sm="right" label-cols-sm="4" label-cols-lg="3" label="To:">
                                                            <b-form-datepicker v-model="user.to"></b-form-datepicker>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                                <b-row class="mt-3 mb-2">
                                                    <b-col md="12">
                                                        <b-form-group label-align-sm="right" label-cols-sm="4" label-cols-lg="3" label="Day:">
                                                            <b-form-checkbox-group v-model="user.days" :options="user.dayOptions"></b-form-checkbox-group>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                                <!-- EVENT DETAILS -->

                                                <!--SAVE BUTTON-->
                                                <b-button variant="success" size="sm" class="w3-right" @click="insertEvent()" :disabled="button.save">Save</b-button>
                                            </b-card>
                                        </b-form-group>
                                    </b-container>
                                </div>
                                <div class="col-lg-6" style="height:500px">
                                    <b-container fluid class="mt-5">
                                        <b-form-group>
                                            <b-table :items="table.items" :fields="table.fields" :tbody-tr-class="rowClass" bordered responsive style="height:400px" ></b-table>
                                        </b-form-group>
                                    </b-container>
                                </div>
                            </div>
                            <!-- Event Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyrights text-center mb-4" style="color:#f9f9f9;">
            <p>Calendar Event 2021 by <a href="#" class="external" style="color:#f9f9f9;">Rodolfo Lobusta Jr</a></p>
        </div>
    </div>
</template>

<style>
.bg-login-image {
  background: url("/image/image.jpg");
  background-position: center;
  background-size: cover;
}
</style>

<script>
    export default {
        mounted() {
            this.formShow('registration');
            this.selectEvent(0);
        },
        data(){
            return{
                form:{
                    registration: false,
                    event: false,
                },

                user:{
                    name: null,
                    event_name: null,
                    from: null,
                    to: null,
                    days: [],
                    dayOptions: [
                        { text: 'Mon', value: 'Monday' },
                        { text: 'Tue', value: 'Tuesday' },
                        { text: 'Wed', value: 'Wednesday' },
                        { text: 'Thur', value: 'Thursday' },
                        { text: 'Fri', value: 'Friday' },
                        { text: 'Sat', value: 'Saturday' },
                        { text: 'Sun', value: 'Sunday' },
                    ]
                },

                table: {
                    fields: [
                        { key: 'date', label: 'Date', sortable: false}, 
                        { key: 'event', label: 'Event', sortable: false},
                    ],
                    items: []
                },

                button: {
                    save: false
                }
            }
        },
        methods:{
            //form
            formShow(form){
                if(form == 'registration'){
                    this.form.registration = true
                    this.form.event = false
                }else if(form == 'event'){
                    if(this.user.name != null){
                        this.form.registration = false
                        this.form.event = true

                        this.user.name = this.user.name.toUpperCase();
                    }else{
                        this.$bvToast.toast('Your name is required.', {
                            title: 'Warning',
                            variant: 'danger',
                            solid: true,
                            appendToast: false,
                            autoHideDelay: 2000,
                        })
                    }
                }
            },
            //row data class
            rowClass(item, type) {
                if (!item || type !== 'row') return
                if (item.status === 'event') return 'table-success'
                if (item.status === 'month') return 'table-primary'
            },
            //insert event 
            insertEvent(){
                this.button.save = true
                if(this.eventValidations()){
                    if(this.dateValidations()){
                        axios.post('/event/insert',{
                            user_name: this.user.name,
                            event_name: this.user.event_name,
                            from: this.user.from,
                            to: this.user.to,
                            days: this.user.days,
                        })
                        .then((response) => {
                            var event_id = response.data;
                            this.selectEvent(event_id);

                            this.user.event_name = null
                            this.user.from = null
                            this.user.to = null
                            this.user.days = []

                            this.$bvToast.toast('Saved', {
                                title: 'Event',
                                variant: 'success',
                                solid: true,
                                appendToast: false,
                                autoHideDelay: 2000,
                            })

                            this.button.save = false
                        })
                        .catch((error) => {

                        });
                    }else{
                        this.$bvToast.toast('Invalid date range format.', {
                            title: 'Warning',
                            variant: 'danger',
                            solid: true,
                            appendToast: false,
                            autoHideDelay: 2000,
                        })
                        this.button.save = false
                    }
                    
                }else{
                    this.$bvToast.toast('Please fill-up required fields.', {
                        title: 'Warning',
                        variant: 'danger',
                        solid: true,
                        appendToast: false,
                        autoHideDelay: 2000,
                    })
                    this.button.save = false
                }
                
            },
            //select event 
            selectEvent(event_id){
                axios.post('/event/select',{
                    event_id: event_id,
                })
                .then((response) => {
                    this.table.items = response.data
                })
                .catch((error) => {

                });
            },
            //event validations
            eventValidations(){
                if(this.user.event_name == null || this.user.from == null || this.user.to == null || this.user.days.length == 0){
                    return false;
                }else{
                    return true;
                }
            },
            //date rage validations
            dateValidations(){
                this.select_from <= this.select_to
                if(this.user.from <= this.user.to){
                    return true;
                }else{
                    return false;
                }
            }
        }      
    }
</script>

