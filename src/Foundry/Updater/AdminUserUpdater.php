<?php

/*
 * This file is part of SyliusFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Updater;

use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Model\AvatarImageInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Webmozart\Assert\Assert;

final class AdminUserUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
        private FactoryInterface $avatarImageFactory,
        private FileLocatorInterface $fileLocator,
        private ImageUploaderInterface $imageUploader,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        if (!$object instanceof AdminUserInterface) {
            return ($this->decorated)($object, $attributes);
        }

        if ($attributes['api'] ?? null) {
            $object->addRole('ROLE_API_ACCESS');
        }

        $avatar = $attributes['avatar'] ?? null;
        Assert::nullOrString($avatar);

        if (null !== $avatar) {
            $this->createAvatar($object, $avatar);
        }

        unset($attributes['api'], $attributes['avatar']);

        return ($this->decorated)($object, $attributes);
    }

    private function createAvatar(AdminUserInterface $adminUser, string $avatar): void
    {
        /** @var string $imagePath */
        $imagePath = $this->fileLocator->locate($avatar);
        $uploadedImage = new UploadedFile($imagePath, basename($imagePath));

        /** @var AvatarImageInterface $avatarImage */
        $avatarImage = $this->avatarImageFactory->createNew();

        $avatarImage->setFile($uploadedImage);

        $this->imageUploader->upload($avatarImage);

        $adminUser->setAvatar($avatarImage);
    }
}
