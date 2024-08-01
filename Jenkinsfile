pipeline {
    agent { label 'agent-wallet' }


    environment {
        DOCKER_REGISTRY = 'https://registry.hub.docker.com/' // Replace with your Docker registry URL
        DOCKER_REPO = 'wallet-microservice-backend'
        DOCKER_HUB_CREDENTIALS = credentials('dockerpass1')
        DOCKER_USER = 'prashantdpaisa'
        BUILD_NUMBER = "${BUILD_NUMBER}"
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Change File/Folder Permissions'){
            steps{
                script{
                      // Print the current directory to debug
                    sh "pwd"

                    // List the contents of the current directory to debug
                    sh "ls -la"

                    // Change the files permissions
                    sh "chmod -R u+rwx,o+rwx ./src"

                  
                }
            }
        }

        stage('Build and Push Docker Images') {
            parallel {
                stage('Backend') {
                    steps {
                        dir('./') {
                            sh "docker --version"
                            sh "docker build -t ${DOCKER_USER}/${DOCKER_REPO}:${BUILD_NUMBER} -f ./nginx.dockerfile ."
                            script {
                                
                                def dockerCredentials = credentials('dockerpass1')
                                withCredentials([usernamePassword(credentialsId: 'dockerpass1', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
                                    sh(script: """
                                        echo \$DOCKER_PASS | docker login -u \$DOCKER_USER --password-stdin $DOCKER_REGISTRY
                                    """, returnStatus: true)
                                sh "docker push ${DOCKER_USER}/${DOCKER_REPO}:${BUILD_NUMBER}"

                                } 
                            
                            }
                        }
                    }
                }

            }
        }


        stage('Deploy') {
            steps {
                script {
                    
                    withCredentials([usernamePassword(credentialsId: 'dockerpass1', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
                        sh(script: """
                            echo \$DOCKER_PASS | docker login -u \$DOCKER_USER --password-stdin $DOCKER_REGISTRY
                        """, returnStatus: true)
                    // sh "docker-compose -f docker-compose.prod.yaml down"    
                    sh "docker-compose -f docker-compose.stag.yaml pull" // pull all the images defined in the compose file
                    sh "docker-compose -p wallet-microservice-backend -f docker-compose.stag.yaml up -d"

           
                    }    
                    
                }
            }
        }
    }
}