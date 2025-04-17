<script setup>
import Container from "../../components/Container.vue";
import ErrorMessages from "../../components/ErrorMessages.vue";
import InputField from "../../components/InputField.vue";
import PrimaryBtn from "../../components/PrimaryBtn.vue";
import TextLink from "../../components/TextLink.vue";
import Title from "../../components/Title.vue";
import { useForm } from "@inertiajs/vue3";
import SessionMessages from "../../components/SessionMessages.vue";

const form=useForm({
password:"",

});

defineProps({
    status:String
})
const submit=()=>{
    form.post(route('password.send'),{
        onFinish:()=>form.reset('password')
    });

}

</script>

<template>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title> Confirm password</Title>

        </div>
<ErrorMessages :errors="form.errors"/>
<SessionMessages :status="status"/>
        <form @submit.prevent="submit" class="space-y-6">




            <InputField v-model="form.password" label="Password" type="password" icon="key" />


            <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
        </form>
    </Container>
</template>
