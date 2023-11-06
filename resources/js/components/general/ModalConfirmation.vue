<template>
    <v-container>
        <v-dialog
            :modelValue="show"
            transition="dialog-bottom-transition"
            max-width="380px"
            persistent
        >
            <v-form
                @submit.prevent=""
                lazy-validation
                ref="form"
            >
                <v-card>
                    <v-card-title>
                        <div class="text-overline mb-4">
                            Confirm Action
                        </div>
                    </v-card-title>
          
                    <v-card-text>
                        <v-container>
                            <div class="form-group row">
                                <div class="col-12">
                                    <p class="text-h5 mb-1" v-html="question">
                                        
                                    </p>
                                </div>
                            </div>
                        </v-container>
                    </v-card-text>
                    
                    <v-card-actions>
                        <v-spacer></v-spacer>
          
                        <div class="form-group float-right">
                            <v-btn
                                depressed
                                @click="handleCancel()"
                            >
                                No
                            </v-btn>
                            <v-btn
                                depressed
                                color="primary"
                                @click="handleConfirm()"
                            >
                                Yes
                            </v-btn>
                        </div>
                    </v-card-actions>
                
                </v-card>
            </v-form>
        </v-dialog>
    </v-container>
</template>

<script>
export default {
    props: ['show', 'questionParam', 'argsParam'],
    data: ()=> ({
        question: '',
        args: null
    }),
    mounted() {
        this.question = (this.questionParam ? this.questionParam : '');
        this.args = (this.argsParam ? this.argsParam : null);
    },
    watch: {
        questionParam: function(newVal, oldVal) {
            this.question = newVal;
        },
        argsParam: function(newVal, oldVal) {
            this.args = newVal;
        },
    },
    methods: {
        handleCancel: function() {
            this.$emit('on-cancel');
        },
        handleConfirm: function() {
            this.$emit('on-confirm', this.args);
        }
    }
}
</script>