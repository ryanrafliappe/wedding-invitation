<script setup>
import { onMounted, ref } from 'vue';
import { useMessagesStore } from '@/Stores/messagesStore';

const props = defineProps({
    messages: Array
})

const messagesStore = useMessagesStore();

if (props.messages?.length) {
    messagesStore.messages = [...props.messages];
}

const name = ref('');
const message = ref('');
const feedbackMessage = ref('');
const feedbackSuccess = ref(false);
const submitting = ref(false);

const submitForm = async () => {
    if (!name.value.trim() || !message.value.trim()) {
        feedbackMessage.value = "Nama dan pesan tidak boleh kosong";
        feedbackSuccess.value = false;
        return;
    }

    submitting.value = true;
    feedbackMessage.value = '';

    try {
        const response = await fetch('/api/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                sender: name.value,
                message: message.value
            })
        })

        if (!response.ok) {
            const data = await response.json();
            throw new Error(data.message || 'Pesan gagal dikirim');
        }

        const newMessage = {
            sender: name.value, 
            message: message.value,
            timestamp: new Date().toISOString()
        }

        messagesStore.addMessage(newMessage);

        name.value = '';
        message.value = '';
        feedbackMessage.value = 'Pesan berhasil dikirim';
        feedbackSuccess.value = true;
    } catch (error) {
        feedbackMessage.value = error.message || 'Terjadi kesalahan';
        feedbackSuccess.value = false;
    } finally {
        submitting.value = false;
    }
}

onMounted(() => {
    messagesStore.fetchMessages();
})
</script>

<template>
    <div class="h-screen mx-8 mt-12 mb-6">
        <h1 data-aos="fade-up" data-aos-duration="500" class="text-3xl font-main text-end text-emerald-600">Pesan</h1>

        <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="500" id="form" class="flex flex-col ">
            <input
                type="text"
                v-model="name"
                class="w-full h-12 p-2 mt-6 border border-gray-200 rounded-lg bg-gray-50 active:border-emerald-900 focus:border-emerald-900"
                placeholder="Masukkan nama Anda.." >
            <textarea
                v-model="message"
                class="w-full h-32 p-2 mt-2 border border-gray-200 rounded-lg bg-gray-50 active:border-emerald-900 focus:border-emerald-900"
                id=""
                placeholder="masukkan pesan Anda di sini.."></textarea>

            <p v-if="feedbackMessage" :class="{'text-red-600': !feedbackSuccess, 'text-emerald-600': feedbackSuccess, 'text-sm italic text-end': true}" class="mt-2">
                {{ feedbackMessage }}
            </p>
    
            <button
                @click="submitForm"
                :disabled="submitting"
                class="px-4 py-2 mt-4 text-sm text-white rounded-full bg-emerald-900 hover:bg-emerald-700">
                {{ submitting ? 'Mengirim...' : 'Kirim Pesan' }}
            </button>
        </div>

        <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="500" id="messages" class="mt-8 overflow-y-scroll rounded-lg h-96 bg-gray-50">
            <div v-if="messagesStore.messages.length > 0">
                <div v-for="(message, index) in messagesStore.messages" :key="index" class="p-4 mb-4 border-b border-gray-200">
                    <p class="text-sm text-gray-600">{{ message.sender }}</p>
                    <p class="text-lg text-gray-800">{{ message.message }}</p>
                </div>
            </div>
            <div v-else class="flex items-center justify-center h-full">
                <p class="italic text-center text-gray-500">Belum ada pesan yang tersedia.</p>
            </div>
        </div>
    </div>
</template>