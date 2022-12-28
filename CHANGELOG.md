# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.3.0](https://github.com/loophp/iterators/compare/2.2.0...2.3.0)

### Commits

- fix: `ReductionIterableAggreate` must yield the initial value first [`6c43b9a`](https://github.com/loophp/iterators/commit/6c43b9aadedc1b0ab7f44cafa89536be4b563374)

## [2.2.0](https://github.com/loophp/iterators/compare/2.1.0...2.2.0) - 2022-12-28

### Merged

- chore(deps): update actions/stale action to v7 [`#32`](https://github.com/loophp/iterators/pull/32)

### Commits

- docs: update changelog [`7cd68e6`](https://github.com/loophp/iterators/commit/7cd68e65c9f8c06d11744d07e072cb4d7a05274f)
- fix: `ReductionIterableAggreate` must yield the initial value when input is empty [`91640a4`](https://github.com/loophp/iterators/commit/91640a435a40e55720a991f7d43d376b0186de02)
- docs: update Readme badges [`23383f0`](https://github.com/loophp/iterators/commit/23383f03619d10f7912f96ac088ab7753532d7b3)
- fix: update SA annotations [`fae69fe`](https://github.com/loophp/iterators/commit/fae69fe89ec58ac637c1a907b055ce71985dd475)
- update code for PHP 8 - fix tests [`8c18ff4`](https://github.com/loophp/iterators/commit/8c18ff4927946bba74d096c7b3a3ea1b03dc0f3b)
- update code for PHP 8 [`8ef4a6b`](https://github.com/loophp/iterators/commit/8ef4a6b3cd871f368b2c4bddd9fbe94150d6e792)

## [2.1.0](https://github.com/loophp/iterators/compare/2.0.2...2.1.0) - 2022-11-28

### Merged

- chore(deps): update actions/stale action to v6 [`#30`](https://github.com/loophp/iterators/pull/30)
- chore(deps): add renovate.json [`#29`](https://github.com/loophp/iterators/pull/29)

### Commits

- docs: update changelog [`ea4a2d3`](https://github.com/loophp/iterators/commit/ea4a2d39134a57e24073b3db88c063ae2b2bde98)
- update code for PHP 8 [`e4bb414`](https://github.com/loophp/iterators/commit/e4bb4140bab07fb0afa9f4e66e0f9194809b6775)
- nix: update `.envrc` [`f3b5a5e`](https://github.com/loophp/iterators/commit/f3b5a5ea4ee9d7b6972d1b8f56e57494bb8a4498)
- update `composer.json`, require `php &gt;= 8` [`6f75985`](https://github.com/loophp/iterators/commit/6f759857600cbe7fd40c986be99fa98c14ab4f8c)
- Prettify [`4d1c986`](https://github.com/loophp/iterators/commit/4d1c9868325ab84bdf43d1405538035c3c44e4fb)
- chore: update grumphp configuration [`d9a5a86`](https://github.com/loophp/iterators/commit/d9a5a86706b3b701b634ac9db4b76d3a7501152c)

## [2.0.2](https://github.com/loophp/iterators/compare/2.0.1...2.0.2) - 2022-11-12

### Commits

- docs: update changelog [`ec3d429`](https://github.com/loophp/iterators/commit/ec3d4299aed752c0e29d856e54409c4583077df1)
- Use decorator pattern to avoid duplicating code. [`29ed1da`](https://github.com/loophp/iterators/commit/29ed1da85f0d469f4bca4155990d0da86ada4fb1)

## [2.0.1](https://github.com/loophp/iterators/compare/2.0.0...2.0.1) - 2022-11-10

### Merged

- chore(deps): Bump shivammathur/setup-php from 2.18.1 to 2.22.0 [`#28`](https://github.com/loophp/iterators/pull/28)
- chore(deps): Bump cachix/install-nix-action from 17 to 18 [`#27`](https://github.com/loophp/iterators/pull/27)

### Commits

- docs: update changelog [`2a8083d`](https://github.com/loophp/iterators/commit/2a8083dba5a6eec212bcba092b45ba247aa98440)
- fix: update `CachingIteratorAggregate` [`044da03`](https://github.com/loophp/iterators/commit/044da037cc61677503b596ad728baa4450c6293d)
- ci: update [`9f02861`](https://github.com/loophp/iterators/commit/9f028618f1a786220f7d071f30ac8a62fa44a166)
- Autofix code style. [`9aa76fc`](https://github.com/loophp/iterators/commit/9aa76fcff0fec668ab6aea51a858e78343d23fb7)
- ci: update workflows [`f07700d`](https://github.com/loophp/iterators/commit/f07700d87a3ebf008df3b79feb003f6bf5e88e16)

## [2.0.0](https://github.com/loophp/iterators/compare/1.6.13...2.0.0) - 2022-09-11

### Commits

- **Breaking change:** refactor: Rename `TypedIteratorAggregate` into `TypedIterableAggregate`. [`684a018`](https://github.com/loophp/iterators/commit/684a0181711fb6a5864069da67a5b0d5dba7944a)
- docs: Update CHANGELOG. [`17a8621`](https://github.com/loophp/iterators/commit/17a86214c12ee5284a5faa5203ba2a98c65e56bb)
- chore: Do not export `.prettierrc` file. [`061d36c`](https://github.com/loophp/iterators/commit/061d36cdfd1365dacb22e452c10ab4d0c085d3c7)
- ci: Fix Github workflow. [`ffbb643`](https://github.com/loophp/iterators/commit/ffbb6437ddd01d13893cc76354c5fc495dd81449)
- cs: Autofix code style. [`5298919`](https://github.com/loophp/iterators/commit/52989196530817ec7a4e9eb5ef676936be66504d)
- chore: Update static files. [`5037520`](https://github.com/loophp/iterators/commit/50375207042766f3d30b27b0ecb289ba1e109b48)
- ci: Update branch. [`1bafe72`](https://github.com/loophp/iterators/commit/1bafe7235b958629de94063b6496496caf31900b)
- chore: Update `.scrutinizer`. [`05aa029`](https://github.com/loophp/iterators/commit/05aa029149d4a0dfdc5b62f9eb4fd9e993ad5f01)
- fix: Prettify codebase. [`170749b`](https://github.com/loophp/iterators/commit/170749bf44e324a9dd15da7b1b32012f76f0438c)
- chore: Remove `phpcs` configuration. [`b62dc69`](https://github.com/loophp/iterators/commit/b62dc69da5d1d82b217569a31d4342a0df0d19ab)
- chore: Update `.gitattributes`. [`219e8c3`](https://github.com/loophp/iterators/commit/219e8c3fc02a9a8c0aa9d354b9cc1f20e8683ee2)
- chore: Add `prettier`. [`ec032f9`](https://github.com/loophp/iterators/commit/ec032f9461934c9ff42271b7b6f6431851948f3c)
- docs: Update CHANGELOG. [`9ed8c44`](https://github.com/loophp/iterators/commit/9ed8c446ae8a159b2b47eee26f6a140e368ce0ea)
- docs: Update README. [`eaddfcf`](https://github.com/loophp/iterators/commit/eaddfcf893932f6c6c222fbfef0e376cb396b8f4)
- docs: Update CHANGELOG.md [`64685ee`](https://github.com/loophp/iterators/commit/64685ee6303205571ef117d06d4162b7c2b381eb)
- fix: Reduce amount of local variables thanks to PHPStan fix. [`4ad921f`](https://github.com/loophp/iterators/commit/4ad921f2f03352cab4b43aacf1da9ca3388ea394)
- fix: Fix typing. [`95da1a1`](https://github.com/loophp/iterators/commit/95da1a16b0cc96c92536183a47c75d83c6c03ecd)
- chore: Update composer scripts. [`2923f73`](https://github.com/loophp/iterators/commit/2923f7351745879bebef561ebfe1a1d36ee4b173)
- fix: Deprecate `SimpleCachingIteratorAggregate`. [`c485047`](https://github.com/loophp/iterators/commit/c48504787fa5e0e7345e4303e9a5739171890ed9)
- chore: Cleanup in `.gitattributes`. [`f4e3d2b`](https://github.com/loophp/iterators/commit/f4e3d2b6b89c9a7dfc351848a0860805b6a05de1)
- fix: Static analysis fix. [`de29db6`](https://github.com/loophp/iterators/commit/de29db6ae185545ec4008b3da8935f79e84e7208)
- fix: Static analysis fix. [`cb54a40`](https://github.com/loophp/iterators/commit/cb54a40e3312e4aabeff3a33cb395fddab67cda4)
- ci: Update Scrutinizer configuration. [`985b867`](https://github.com/loophp/iterators/commit/985b867e65162eaab556300f5cb238ba157826d9)
- ci: Update Scrutinizer configuration. [`31841bb`](https://github.com/loophp/iterators/commit/31841bbfaf66ae77045a22a26e44f02837c05ced)
- chore: Minor configuration modification of PHPUnit and Infection. [`87a16f8`](https://github.com/loophp/iterators/commit/87a16f8a95b288e406ca9018a5578ab27749eb9b)
- Autofix code style. [`a4373f8`](https://github.com/loophp/iterators/commit/a4373f8da02774e58d1d10e605e087c47f6e7648)
- chore: Remove docker stuff. [`582b214`](https://github.com/loophp/iterators/commit/582b214cb8035ce02386b9f00fe18db932a49bdb)
- docs: Update changelog. [`fb30030`](https://github.com/loophp/iterators/commit/fb300304f566e9257331787dfc9620d494e41bac)
- chore: Remove obsolete docker stuff. [`227b90a`](https://github.com/loophp/iterators/commit/227b90ad86216214fc17f61c429bfd1075f96926)
- docs: Update changelog. [`135aaf7`](https://github.com/loophp/iterators/commit/135aaf7cd560172d5aba5069431252737ae44dd3)
- chore: Remove obsolete docker stuff. [`92d439c`](https://github.com/loophp/iterators/commit/92d439c212ad3f6f01fa2831d84567b866a687a0)
- Autofix code style [`a727898`](https://github.com/loophp/iterators/commit/a727898ae511bf18c60b2982cce287ec162c997d)
- Fix typing information. [`d58062e`](https://github.com/loophp/iterators/commit/d58062e524795c7e81fe5d4528782df8563e68a6)
- Minor optimization. [`4513b92`](https://github.com/loophp/iterators/commit/4513b92acec0e2331f1318068821a0ec6e82431a)

## [1.6.13](https://github.com/loophp/iterators/compare/1.6.12...1.6.13) - 2022-06-25

### Commits

- docs: Add/update CHANGELOG. [`4c04f6a`](https://github.com/loophp/iterators/commit/4c04f6a5449603817d9ea8806cef40df962dc6af)
- chore: Update commands to generate changelogs, get rid of docker. [`5887473`](https://github.com/loophp/iterators/commit/5887473c49e6ca87a9a4648ae392450b31048bfc)
- Fix typing information [`171c65b`](https://github.com/loophp/iterators/commit/171c65ba6876e0277b77f7de33abd7861e6b61a6)

## [1.6.12](https://github.com/loophp/iterators/compare/1.6.11...1.6.12) - 2022-06-24

### Commits

- feat: Add `ReductionIterableAggregate`. [`47c28f5`](https://github.com/loophp/iterators/commit/47c28f5e25ba89ad3f9f827cfeb4b3eec26ad4fc)
- Minor change. [`d9b765b`](https://github.com/loophp/iterators/commit/d9b765b4aad65561e93d00a42d2180e711e35de1)

## [1.6.11](https://github.com/loophp/iterators/compare/1.6.10...1.6.11) - 2022-06-24

### Commits

- Update typing information. [`cce4a61`](https://github.com/loophp/iterators/commit/cce4a61793fcedbac63fc05f1767ee22ad424a85)
- Update typing information. [`1e17fc6`](https://github.com/loophp/iterators/commit/1e17fc66aabfc3fd92cb5ad7d4fa6a91b9c8dc91)
- Replace `Traversable` with `Generator`. [`8b8ea0b`](https://github.com/loophp/iterators/commit/8b8ea0ba32f79974b8a113bf2228895f4ed08bc2)

## [1.6.10](https://github.com/loophp/iterators/compare/1.6.9...1.6.10) - 2022-06-16

### Commits

- refactor: Update `UniqueIterableAggregate`. [`c356e63`](https://github.com/loophp/iterators/commit/c356e6360f4c3346bc524ad0e1e7514f021596b7)

## [1.6.9](https://github.com/loophp/iterators/compare/1.6.8...1.6.9) - 2022-06-15

### Commits

- feat: add `ChunkIterableAggregate`. [`b736ca3`](https://github.com/loophp/iterators/commit/b736ca3531e479153da6b115990e48aa587bee33)

## [1.6.8](https://github.com/loophp/iterators/compare/1.6.7...1.6.8) - 2022-06-15

### Commits

- feat: Add `MapIterableAggregate` and `FilterIterableAggregate`. [`6ea3e45`](https://github.com/loophp/iterators/commit/6ea3e45482564e5fd2a62c8e26eb5a5557a3b8bc)

## [1.6.7](https://github.com/loophp/iterators/compare/1.6.6...1.6.7) - 2022-06-14

### Commits

- feat: Add `UniqueIterableAggregate`. [`eef38bc`](https://github.com/loophp/iterators/commit/eef38bcef437517919c455a23e97ccb9751125ac)

## [1.6.6](https://github.com/loophp/iterators/compare/1.6.5...1.6.6) - 2022-06-13

### Commits

- fix: remove `mt_srand` from constructor method. [`3a55e45`](https://github.com/loophp/iterators/commit/3a55e45df7952ab6af34a7deeb65b9cdf7ec651d)

## [1.6.5](https://github.com/loophp/iterators/compare/1.6.4...1.6.5) - 2022-06-13

### Commits

- feat: add `MersenneTwisterRNGIteratorAggregate`. [`f487185`](https://github.com/loophp/iterators/commit/f4871855be191488a9c4f284a54e9b949c1b7991)

## [1.6.4](https://github.com/loophp/iterators/compare/1.6.3...1.6.4) - 2022-06-13

### Commits

- feat: Add `InterruptableIterableAggregate`. [`11c558a`](https://github.com/loophp/iterators/commit/11c558ad574ec47d805d572fe89682eae25284b7)

## [1.6.3](https://github.com/loophp/iterators/compare/1.6.2...1.6.3) - 2022-06-03

### Merged

- chore(deps): Bump actions/stale from 4 to 5 [`#17`](https://github.com/loophp/iterators/pull/17)
- chore(deps): Bump shivammathur/setup-php from 2.18.0 to 2.18.1 [`#16`](https://github.com/loophp/iterators/pull/16)

### Commits

- fix: Update SA of `SimpleCachingIteratorAggregate`. [`1010776`](https://github.com/loophp/iterators/commit/1010776a4c0f70ceb2eb4a7d71fc9246940138b7)
- Fix Scrutinizer. [`856c521`](https://github.com/loophp/iterators/commit/856c5213259a3b024cbcbc8fc0c08ae9439dc1cf)

## [1.6.2](https://github.com/loophp/iterators/compare/1.6.1...1.6.2) - 2022-03-27

### Commits

- docs: Add/update CHANGELOG. [`9f915e4`](https://github.com/loophp/iterators/commit/9f915e4a24c96690d7b543bd18ddc45310e8e093)
- Revert "Prevent errors when the iterable is an already closed generator." [`e5690c7`](https://github.com/loophp/iterators/commit/e5690c7d3be2f833330af5b39b27a8dc4bfd565c)

## [1.6.1](https://github.com/loophp/iterators/compare/1.6.0...1.6.1) - 2022-03-26

### Merged

- chore(deps): Bump shivammathur/setup-php from 2.17.1 to 2.18.0 [`#15`](https://github.com/loophp/iterators/pull/15)
- chore(deps): Bump actions/cache from 2.1.7 to 3 [`#14`](https://github.com/loophp/iterators/pull/14)

### Commits

- docs: Add/update CHANGELOG. [`cf1232f`](https://github.com/loophp/iterators/commit/cf1232f0d7cf1bdcf30e6425dd098e25e0ab9dfc)
- Prevent errors when the iterable is an already closed generator. [`43e4e43`](https://github.com/loophp/iterators/commit/43e4e4391d5756a9cd1f4f6d1ea38707670254d2)

## [1.6.0](https://github.com/loophp/iterators/compare/1.5.14...1.6.0) - 2022-03-13

### Merged

- chore(deps): Bump actions/checkout from 2.4.0 to 3 [`#12`](https://github.com/loophp/iterators/pull/12)
- chore(deps): Bump shivammathur/setup-php from 2.17.0 to 2.17.1 [`#13`](https://github.com/loophp/iterators/pull/13)
- chore(deps): Bump shivammathur/setup-php from 2.16.0 to 2.17.0 [`#11`](https://github.com/loophp/iterators/pull/11)

### Commits

- docs: Add/update CHANGELOG. [`ef3f7a4`](https://github.com/loophp/iterators/commit/ef3f7a44d708794355b9f21b460c233397de08f7)
- feat: Add `hasNext` method to Caching iterator aggregates. [`0d80e09`](https://github.com/loophp/iterators/commit/0d80e0938c416fee63b3546eb884861fbd85de88)

## [1.5.14](https://github.com/loophp/iterators/compare/1.5.13...1.5.14) - 2022-01-30

### Commits

- docs: Add/update CHANGELOG. [`f1959ff`](https://github.com/loophp/iterators/commit/f1959fff47d0015dfa8cf94954eea21990d15f41)
- feat: Add `LimitIterableAggregator`. [`0a1955e`](https://github.com/loophp/iterators/commit/0a1955e6b52440c38fdd6c50677de6889f835fca)

## [1.5.13](https://github.com/loophp/iterators/compare/1.5.12...1.5.13) - 2022-01-28

### Commits

- docs: Add/update CHANGELOG. [`815497d`](https://github.com/loophp/iterators/commit/815497d6c0c2009e41117ab76546991bfd9b4b7a)
- fix: Fix SA annotations. [`6a66d07`](https://github.com/loophp/iterators/commit/6a66d0774cd796de3b00dba18614f2f73b247b73)
- feat: Add new Iterator aggregates. [`04db72d`](https://github.com/loophp/iterators/commit/04db72deaa16effda94b00fb7b6edf86c137ce0a)

## [1.5.12](https://github.com/loophp/iterators/compare/1.5.11...1.5.12) - 2022-01-26

### Commits

- docs: Add/update CHANGELOG. [`f88c556`](https://github.com/loophp/iterators/commit/f88c556d4f1a7db90c85f5b055ab1fe3a8a761b2)
- feat: Performance improvements. [`0b9afd7`](https://github.com/loophp/iterators/commit/0b9afd7039063c2e60092b39efbb266bf91976bf)

## [1.5.11](https://github.com/loophp/iterators/compare/1.5.10...1.5.11) - 2022-01-25

### Commits

- docs: Add/update CHANGELOG. [`082e62a`](https://github.com/loophp/iterators/commit/082e62a5e8d8f744915e031f2743c2a80f8d6036)
- Fix tests. [`e831ac2`](https://github.com/loophp/iterators/commit/e831ac2de668e764cfdbf090e1f1196b77663b1e)

## [1.5.10](https://github.com/loophp/iterators/compare/1.5.9...1.5.10) - 2022-01-25

### Commits

- docs: Add/update CHANGELOG. [`6555579`](https://github.com/loophp/iterators/commit/655557999b64bcae48e7b27c6b0caf9c36c413f4)
- Rename `NormalizeIteratorAggregate` class. [`9b4d23b`](https://github.com/loophp/iterators/commit/9b4d23b9e2f1b1b22c30ffee76088dac5f08f1f1)

## [1.5.9](https://github.com/loophp/iterators/compare/1.5.8...1.5.9) - 2022-01-25

### Commits

- docs: Add/update CHANGELOG. [`a5262ed`](https://github.com/loophp/iterators/commit/a5262ed09a283ec39149091d9ba8046e6f1e9b83)
- Fix coverage. [`864906d`](https://github.com/loophp/iterators/commit/864906dd47713edd7b30355bd18fa4861f548714)
- feat: Add `NormalizeIteratorAggregate`. [`24d2e8c`](https://github.com/loophp/iterators/commit/24d2e8c3086f589a880ab9c0571521fced75f28f)
- feat: Add `InfiniteIteratorAggregate`. [`4c0a797`](https://github.com/loophp/iterators/commit/4c0a7979a982d1c30a5678216fd900fe4fd66c7b)
- feat: Improve performance of `IterableIteratorAggregate`. [`f9c2e1c`](https://github.com/loophp/iterators/commit/f9c2e1c93c7f9caf26e64ea55e7502c1df1ffd25)

## [1.5.8](https://github.com/loophp/iterators/compare/1.5.7...1.5.8) - 2022-01-24

### Commits

- docs: Add/update CHANGELOG. [`2c3026f`](https://github.com/loophp/iterators/commit/2c3026f8052d3513dfd505eebc172b22929cd7e4)
- fix: Change `Closure` to `callable`. [`e4454ea`](https://github.com/loophp/iterators/commit/e4454ea91b6f18a26dd5a6798247e161da69fcd3)

## [1.5.7](https://github.com/loophp/iterators/compare/1.5.6...1.5.7) - 2022-01-24

### Commits

- docs: Add/update CHANGELOG. [`bf3f2c7`](https://github.com/loophp/iterators/commit/bf3f2c720b76c3bb10b7852686c288d9b2e98b56)
- docs: Update `README`. [`a35dfe6`](https://github.com/loophp/iterators/commit/a35dfe643e8c54b6407974a3e244e6be665043b1)
- feat: Add `ResourceIteratorAggregate`. [`124d4bd`](https://github.com/loophp/iterators/commit/124d4bdb21e229080570245a3ed5ea1015a88e71)
- tests: Update tests for `TypedIteratorAggregate`. [`6008d71`](https://github.com/loophp/iterators/commit/6008d710a5be4660454c19aa4ebc3112445d09a7)
- cs: Autofix code-style. [`076cfea`](https://github.com/loophp/iterators/commit/076cfea3f824203c6e675dff84924d485a12973a)
- feat: Add `TypedIteratorAggregate`. [`8adcf3e`](https://github.com/loophp/iterators/commit/8adcf3e397cf9362260b7c482689c6ba13b89e67)
- feat: Add `TypedIteratorAggregate`. [`651ed86`](https://github.com/loophp/iterators/commit/651ed86e058f669f77537647fef0f5b3691622d1)
- tests: Add more `StringIteratorAggregate` tests. [`86bd0c0`](https://github.com/loophp/iterators/commit/86bd0c034ef5f4a8dc30b7d13fc0cfccd869e0ab)
- chore: Remove obsolete dev dependency. [`3a318db`](https://github.com/loophp/iterators/commit/3a318db89ab52db5e5023e4d184659947c2b6ef6)

## [1.5.6](https://github.com/loophp/iterators/compare/1.5.5...1.5.6) - 2022-01-23

### Merged

- optim: Minor optimizations here and there. [`#9`](https://github.com/loophp/iterators/pull/9)
- Minor optimizations [`#8`](https://github.com/loophp/iterators/pull/8)

### Commits

- docs: Add/update CHANGELOG. [`1df4353`](https://github.com/loophp/iterators/commit/1df4353f0de4cb27bcdb0e2965d474e1bbe94c3a)
- Normalize composer.json [`624839b`](https://github.com/loophp/iterators/commit/624839bd9a187724c96c24ab98e4061c47332dd7)
- feat: Add `StringIteratorAggregate`. [`4cadd48`](https://github.com/loophp/iterators/commit/4cadd487aa39d2f00f803d6d9054e68244b94768)
- refactor: Simplify logic. [`7a20ecb`](https://github.com/loophp/iterators/commit/7a20ecb9ea516bbd9da71178119910ed9409d016)
- tests: Enable HTML infection reports. [`4396013`](https://github.com/loophp/iterators/commit/439601301bf5c5f946d06dcb8933c416288e3e27)
- tests: Enable HTML infection reports. [`51cad5a`](https://github.com/loophp/iterators/commit/51cad5a0ce4fe7c1bc77547b2ce231092f6b76cc)
- tests: Reduce amount of items in input dataset to speed up benchmarks. [`055a23a`](https://github.com/loophp/iterators/commit/055a23ad9b85ac99b554912a50c90e2d52e5082a)
- tests: Add `@sleep` annotation. [`4540106`](https://github.com/loophp/iterators/commit/45401063c61051f0471954e2609e2340f9c0e694)
- chore: Update PHPBench configuration. [`59f003a`](https://github.com/loophp/iterators/commit/59f003a9d3798ab1a04e65b9b5fed650b71bcbfc)
- tests: Update `CachingIteratorsAggregateBench`. [`6bfccf1`](https://github.com/loophp/iterators/commit/6bfccf199c0abf63d52440695675943d8f339374)
- tests: Update `SimpleCachingIteratorAggregateBench`. [`e351ad0`](https://github.com/loophp/iterators/commit/e351ad0a8a7b34e4103553bb2e6ccc104d7f7a7f)
- fix: Fix class and filename. [`0405fe3`](https://github.com/loophp/iterators/commit/0405fe3a4ea038fbf31a7f56c1d0a1c4926e9305)
- fix: Use `array-key` instead of `int|string` . [`0e5610a`](https://github.com/loophp/iterators/commit/0e5610a65274cf780bb21fad395bef57662a16a0)
- ci: Update benchmarks workflow. [`152423a`](https://github.com/loophp/iterators/commit/152423af07210fad08be15a38b617d2e2ee3bfd5)
- tests: Add more benchmarks. [`89510e0`](https://github.com/loophp/iterators/commit/89510e00a961bd4cc12c861b2959f45e4d55c44a)
- tests: Update benchmarks configuration. [`8d4f63e`](https://github.com/loophp/iterators/commit/8d4f63e8c67b653c71d24e034f9111dcdd226209)
- tests: Add more tests. [`13bf01c`](https://github.com/loophp/iterators/commit/13bf01c409789a92892c7ede8a960ed5644f99fb)
- sa: Fix type. [`dca22ca`](https://github.com/loophp/iterators/commit/dca22ca4196196e3ee80d92ad6870c13a0a59553)
- tests: Add more tests. [`4b30552`](https://github.com/loophp/iterators/commit/4b3055265ad5bd94c350782ad90bd1502544b1c3)
- sa: Fix type. [`be26f78`](https://github.com/loophp/iterators/commit/be26f7820ccd78ed545cc825f711058033a682c4)
- ci: Update benchmarks. [`e8b7752`](https://github.com/loophp/iterators/commit/e8b77522426af43e185f95b9eb81bee3c8c822af)
- tests: Add unit tests. [`c3ec816`](https://github.com/loophp/iterators/commit/c3ec8164f0117bf2b0d66fa12bd015e116ffb6e3)
- tests: Add unit tests. [`6ecd612`](https://github.com/loophp/iterators/commit/6ecd612f5938323ae5822f7e0cc8b6a989cf8905)
- tests: Rename benchmarks providers. [`ec7005b`](https://github.com/loophp/iterators/commit/ec7005b7c4c027203ab64cbc3486a95b76b05a7e)
- tests: Refactor benchmarks. [`d80150d`](https://github.com/loophp/iterators/commit/d80150decb007f846bbe47ec3d66d817cdaf1814)
- ci: Update benchmarks - Reduce amount of tests. [`a069835`](https://github.com/loophp/iterators/commit/a0698357c162a1d2a8e26833966bd52d6fd7bb49)
- ci: Update benchmarks. [`bf550d0`](https://github.com/loophp/iterators/commit/bf550d0f8878fd4c683e3c6979eca41158f2b8c8)
- Autofix code style. [`3b4b7de`](https://github.com/loophp/iterators/commit/3b4b7decc29ddd69e23082bd16526826389e7837)
- ci: Update benchmarks. [`aeb268e`](https://github.com/loophp/iterators/commit/aeb268eb237f5fa2e292ea1ffd3a8045e927f842)
- Autofix code style. [`5d41205`](https://github.com/loophp/iterators/commit/5d412056510e8b8b4bfec905e4131d607868a946)
- tests: Benchmarks revs update. [`dbd7f90`](https://github.com/loophp/iterators/commit/dbd7f90990a57c2fe90d790bb7e5d83f99ba8b1e)
- tests: Benchmarks revs update. [`3033091`](https://github.com/loophp/iterators/commit/3033091249c8e1ee9866bb18172900cf2e028dc5)
- refactor: Do not make unit assertions in benchmarks. [`8117ebb`](https://github.com/loophp/iterators/commit/8117ebbe49592736fa592d13400bfb40bde3c957)
- chore: Update composer.json [`aedcb38`](https://github.com/loophp/iterators/commit/aedcb3875dc4d5c41ca999015099395da1718c78)
- refactor: Update return types. [`a011304`](https://github.com/loophp/iterators/commit/a011304df52bd96a69a63b111750fd5de0dad165)
- tests: Add more benchmarks [`f7c8446`](https://github.com/loophp/iterators/commit/f7c844641c919a16403a4b64caa9237d8f56b435)
- Normalize composer.json [`c96fb0c`](https://github.com/loophp/iterators/commit/c96fb0cfca9a44451720175c00739e17595fbb3b)
- Revert "ci: Update benchmarks reporting." [`d2d62c3`](https://github.com/loophp/iterators/commit/d2d62c350cef8efec20b63560fa4c7c3f5736c5e)
- ci: Make benchmark groups. [`f7690eb`](https://github.com/loophp/iterators/commit/f7690eb844175ee48a16ffe128e3502860b34681)
- ci: Update benchmarks reporting. [`5aa6161`](https://github.com/loophp/iterators/commit/5aa6161a860139048afc1b3757d534310cf5f7aa)
- feat: Minor optimizations. [`7db1132`](https://github.com/loophp/iterators/commit/7db1132c32214cc60de580d2f1a530051c9fe925)
- tests: Increase Infection timeout [`177f995`](https://github.com/loophp/iterators/commit/177f995b336b1b10a8814c53f8ec4715a90e747f)
- tests: Update benchmarks. [`02198fc`](https://github.com/loophp/iterators/commit/02198fc8e57e4d9d1f95619f547210ed754f1a18)
- ci: Add PHPBench reporting. [`8c2d6c7`](https://github.com/loophp/iterators/commit/8c2d6c78c2312dfade1a20d1c8bbc33a95323f2c)
- tests: Update `CachingIteratorsBench` benchmarks. [`8790e85`](https://github.com/loophp/iterators/commit/8790e85fcb07d37a9447d31f0018ed44a6f92914)
- ci: Update mutation tests. [`a121d7c`](https://github.com/loophp/iterators/commit/a121d7cd6152481330d499a484c8b22a5ab987f4)
- chore: Update license [`b3547a6`](https://github.com/loophp/iterators/commit/b3547a6676d56523c619b3f03ba0625f4b5f4d31)

## [1.5.5](https://github.com/loophp/iterators/compare/1.5.4...1.5.5) - 2022-01-03

### Commits

- docs: Add/update CHANGELOG. [`28102a6`](https://github.com/loophp/iterators/commit/28102a679bc8bdd682f8516904a1aa5eadd09ad4)
- refactor: Minor update in benchmarks. [`d6fc838`](https://github.com/loophp/iterators/commit/d6fc838d9ff90dd1aebf4ff83f7ae587d5a80d6a)

## [1.5.4](https://github.com/loophp/iterators/compare/1.5.3...1.5.4) - 2021-12-31

### Commits

- docs: Add/update CHANGELOG. [`312af5d`](https://github.com/loophp/iterators/commit/312af5dc33860468f16f7e73de3dbe0accd43796)
- fix: Update `SimpleCachingIteratorAggregate` to reach 100% type inference. [`9c82c58`](https://github.com/loophp/iterators/commit/9c82c582f8c25c611c2d190f3e4395c0346b4a41)

## [1.5.3](https://github.com/loophp/iterators/compare/1.5.2...1.5.3) - 2021-12-22

### Commits

- docs: Add/update CHANGELOG. [`baf3352`](https://github.com/loophp/iterators/commit/baf3352762eac1061eb01efedd7dcbc9e48291e2)
- fix: Update return types. [`bac7423`](https://github.com/loophp/iterators/commit/bac7423211133ec9f1f7a778fdc3954e626d263e)

## [1.5.2](https://github.com/loophp/iterators/compare/1.5.1...1.5.2) - 2021-12-22

### Commits

- docs: Add/update CHANGELOG. [`fa6a59e`](https://github.com/loophp/iterators/commit/fa6a59edfd2e6d41a6b9d4b5e41942121e3a8a75)
- fix: Update return types. [`c48eebf`](https://github.com/loophp/iterators/commit/c48eebf18c2638997dbb59ecc2b2b41a9e7fb3ea)

## [1.5.1](https://github.com/loophp/iterators/compare/1.5.0...1.5.1) - 2021-12-22

### Merged

- Fix typo in class name [`#4`](https://github.com/loophp/iterators/pull/4)

### Commits

- docs: Add/update CHANGELOG. [`d1a1ed6`](https://github.com/loophp/iterators/commit/d1a1ed6efe3af84c203c010509f938a44af446c0)
- fix: Make it work with PHP 8.1 [`e119ca7`](https://github.com/loophp/iterators/commit/e119ca73c788aebe1f1c49bdd8b136db9afdf3f4)
- docs: Update badge. [`9050b64`](https://github.com/loophp/iterators/commit/9050b64f1b5de597f6480ea680ccf554c7b5fb4c)

## [1.5.0](https://github.com/loophp/iterators/compare/1.4.0...1.5.0) - 2021-12-21

### Merged

- feat: Add `RandomIteratorAggregate`. [`#3`](https://github.com/loophp/iterators/pull/3)

### Commits

- docs: Add/update CHANGELOG. [`5ee7b03`](https://github.com/loophp/iterators/commit/5ee7b033a29ec401eb5f9ed5be036b1a971fb730)
- docs: Update `README`. [`5e75734`](https://github.com/loophp/iterators/commit/5e75734408ef3c2b9dbe5f4c67074ca9058b49f5)
- ci: Fix scrutinizer upload. [`5f093ec`](https://github.com/loophp/iterators/commit/5f093ece0a625c186bd6108277d6950b7654a38c)
- ci: Fix scrutinizer upload. [`ed9e532`](https://github.com/loophp/iterators/commit/ed9e532797cf8c393d439b61f4451bc3da35b3ee)
- Enable scrutinizer badge. [`d720355`](https://github.com/loophp/iterators/commit/d720355681692205a5413a19c851e9964f348848)
- chore: Update Grumphp configuration. [`2c8e76e`](https://github.com/loophp/iterators/commit/2c8e76e08b4661af23fc56b3efbdd7bd526ae20e)
- Enable infection tests badge. [`6c588bd`](https://github.com/loophp/iterators/commit/6c588bde808513721d4e63cac7d38f38e8db9279)
- Autofix code style. [`dcceb78`](https://github.com/loophp/iterators/commit/dcceb78d3dd7918ab5703a86052cdb8f06fda741)
- tests: Update benchmarks. [`61ebd70`](https://github.com/loophp/iterators/commit/61ebd70a6b04121797ce532a23f8386cf390b804)

## [1.4.0](https://github.com/loophp/iterators/compare/1.3.1...1.4.0) - 2021-12-20

### Merged

- add benchmarks makefile [`#2`](https://github.com/loophp/iterators/pull/2)

### Commits

- docs: Add/update CHANGELOG. [`dd965ff`](https://github.com/loophp/iterators/commit/dd965ffb0b6da0a740dd410bb4cb82cd393db584)
- ci: Send Infection report to StrykerDashboard. [`9506c10`](https://github.com/loophp/iterators/commit/9506c10bc7ce968f80aeb846bdd93fd3a74f46e1)
- ci: Fix branch name. [`bfcbaef`](https://github.com/loophp/iterators/commit/bfcbaef731b896131b6429d45bdeabe3259fc729)
- docs: Update `README`. [`ebb8cdd`](https://github.com/loophp/iterators/commit/ebb8cdd0d14183dcf35a97c7fb4a595e06950626)
- Fix code style. [`a4a8cb5`](https://github.com/loophp/iterators/commit/a4a8cb5ffbd9d2dcd51460a7847c708eac14128d)
- Fix annotations and static analysis. [`4a653b0`](https://github.com/loophp/iterators/commit/4a653b0f038b4948ef9d0d1a2e5970ba25e37034)
- feat: Micro optimizations to improve performance. [`b898474`](https://github.com/loophp/iterators/commit/b8984749efc2c688417b46cbaad2ad663d326b51)
- feat: Add `PausableIteratorAggregate`. [`a806dcc`](https://github.com/loophp/iterators/commit/a806dccd83a09725019d4c1899d52095d3d8477c)
- feat: Micro optimizations to improve performance. [`b0eed19`](https://github.com/loophp/iterators/commit/b0eed19123f805a16271dd4f64923302010d1505)
- Implements micro/minor optimizations. [`d51b7f2`](https://github.com/loophp/iterators/commit/d51b7f2cbe4dc35ab66cff951e020ae9a5d9a841)

## [1.3.1](https://github.com/loophp/iterators/compare/1.3.0...1.3.1) - 2021-12-19

### Commits

- docs: Add/update CHANGELOG. [`a68cec4`](https://github.com/loophp/iterators/commit/a68cec44b18ed1ef1227e3475e533df77b5e3f45)
- fix: Fixed Static Analysis issues. [`707e7b0`](https://github.com/loophp/iterators/commit/707e7b0195bf77aacba9971a618bb35f683dd07e)

## [1.3.0](https://github.com/loophp/iterators/compare/1.2.2...1.3.0) - 2021-12-19

### Commits

- docs: Add/update CHANGELOG. [`7b257ca`](https://github.com/loophp/iterators/commit/7b257ca97e209f8d7c925d78628fd9d3dca1e6a7)
- docs: Update `README.md` - remove constraints. [`b289c71`](https://github.com/loophp/iterators/commit/b289c71b0c960f846e191b3efe83bc31464ccbea)
- feat: Micro optimizations. [`e209721`](https://github.com/loophp/iterators/commit/e20972178d859c15f1a1d33a9cc7a10b77d2b580)
- feat: `SimpleCachingIteratorAggregate` to fail when iterating multiple times. [`c4e92f5`](https://github.com/loophp/iterators/commit/c4e92f521d6b9c882008321e805e8ff0c68011d2)
- Remove not required dev dependencies. [`85a5047`](https://github.com/loophp/iterators/commit/85a5047aa4b4d618559bca3ff17d1144a2c9583d)
- fix: Fixed Static Analysis issues. [`e5d495d`](https://github.com/loophp/iterators/commit/e5d495de89ea2121d11d8a391f23bf4379c7e1e8)
- ci: Tests on PHP 8.1 only. [`feeea9f`](https://github.com/loophp/iterators/commit/feeea9f094659e43f68e7ba7302a5642d96b6118)
- docs: Update `README`. [`d96dada`](https://github.com/loophp/iterators/commit/d96dada81c1b910906b39d5bf6798045190e41bf)
- feat: Add `SimpleCachingIteratorAggregate`. [`69b9896`](https://github.com/loophp/iterators/commit/69b9896a7dbb04f72a5378ee3d0919669e54e2fa)
- cs: Add custom PHP CS Fixer configuration. [`a3b7e80`](https://github.com/loophp/iterators/commit/a3b7e80d0b69b3d8f67243b0adb7ec634d04b0d0)
- tests: Add more tests. [`5201840`](https://github.com/loophp/iterators/commit/5201840a96df0e277855fd6c153a2ba640d518b3)
- feat: Add benchmarks. [`f9b7102`](https://github.com/loophp/iterators/commit/f9b7102cec73ee337143ecdf9a07602c75c9f716)

## [1.2.2](https://github.com/loophp/iterators/compare/1.2.1...1.2.2) - 2021-12-18

### Commits

- docs: Add/update CHANGELOG. [`72ba6b8`](https://github.com/loophp/iterators/commit/72ba6b863acce2166342114ba6061ec83f66681e)
- chore: Update `.gitattributes` file. [`102dd61`](https://github.com/loophp/iterators/commit/102dd6115059aa08a382d1d1fa1ea806dbee3e74)

## [1.2.1](https://github.com/loophp/iterators/compare/1.2.0...1.2.1) - 2021-12-18

### Commits

- docs: Add/update CHANGELOG. [`b90bf2a`](https://github.com/loophp/iterators/commit/b90bf2a5282274e2f5442b473eac7cdc281f7120)
- chore: Update `.gitattributes` file. [`29be8f5`](https://github.com/loophp/iterators/commit/29be8f5b2f27451b0db90130158f08c13efa7fd0)

## [1.2.0](https://github.com/loophp/iterators/compare/1.1.1...1.2.0) - 2021-12-17

### Commits

- docs: Add/update CHANGELOG. [`33f759c`](https://github.com/loophp/iterators/commit/33f759c530783bef37ba981d16c295178e1765f0)
- feat: Add new Iterators. [`8e59d91`](https://github.com/loophp/iterators/commit/8e59d913651925c77f148ad0430109861a3a3d19)

## [1.1.1](https://github.com/loophp/iterators/compare/1.1.0...1.1.1) - 2021-12-17

### Commits

- docs: Add/update CHANGELOG. [`405102f`](https://github.com/loophp/iterators/commit/405102fa1b92d8d1a1b5fd599ac9a40e24390a69)
- Remove method to get the inner Iterator for now. [`5d26c3e`](https://github.com/loophp/iterators/commit/5d26c3e7b153ca895ceb997f9993e47d4f1ea000)
- sa: Improve static analysis annotations and code. [`a0be7d5`](https://github.com/loophp/iterators/commit/a0be7d555b0b5c2cf9f432b49721e60224507913)
- docs: Update badge links in README. [`4ed7324`](https://github.com/loophp/iterators/commit/4ed73248519fb357e397c6425f0b7df5516bb29a)

## [1.1.0](https://github.com/loophp/iterators/compare/1.0.0...1.1.0) - 2021-12-16

### Commits

- docs: Add/update CHANGELOG. [`732a85a`](https://github.com/loophp/iterators/commit/732a85a40a47b114763b99b614809cf300d22db6)
- docs: Update `README` file. [`72dd6a5`](https://github.com/loophp/iterators/commit/72dd6a51a2c74dd5870d53995665e6fd3cfa1298)
- feat: Add `ClosureIteratorAggregate` and `IterableIteratorAggregate`. [`7c99ea1`](https://github.com/loophp/iterators/commit/7c99ea1c962e3dbd533803b9d502ccfb584b9968)
- tests: Add new test. [`3077769`](https://github.com/loophp/iterators/commit/3077769ff96566d11554b606dfc48d9c44d71b88)

## [1.0.0](https://github.com/loophp/iterators/compare/0.0.1...1.0.0) - 2021-12-15

### Commits

- docs: Add/update CHANGELOG. [`db4e248`](https://github.com/loophp/iterators/commit/db4e248cb82e74d0e07005f9a9f41f3c95ddf42b)
- Initial set of files. [`f909609`](https://github.com/loophp/iterators/commit/f9096092df23de3eccf86f6cf61eb83f8e5b2d77)

## 0.0.1 - 2021-12-15

### Commits

- Initial commit. [`ac61aa9`](https://github.com/loophp/iterators/commit/ac61aa98ed97418835beb969f515018c8e85a573)
