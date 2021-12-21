help:                                                                           ## shows this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

install-benchmarks:                                                             ## install all required dependencies to run benchmarks
	composer require phpbench/phpbench azjezz/psl:2.0.x-dev --ignore-platform-reqs

benchmarks: install-benchmarks                                                  ## run benchmarks
	./vendor/bin/phpbench run

create-benchmark-reference: install-benchmarks                                  ## run benchmarks, mark current run as "reference"
	./vendor/bin/phpbench run --tag=benchmark_reference

compare-benchmark-to-reference:                                                 ## run benchmarks, compare result to the "reference" run
	./vendor/bin/phpbench run --ref=benchmark_reference
