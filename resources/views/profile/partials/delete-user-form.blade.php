<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('アカウントを削除する') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('一度削除を実行してしまうと、データは失われてしまいます。アカウントを削除する前にもう一度見返し必要な情報はダウンロードし、保存しておいてください。') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('本当に削除しますか') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('一度削除を実行してしまうと、データは失われてしまいます。パスワードを入力して削除を確定してください。') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('アカウント削除') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
